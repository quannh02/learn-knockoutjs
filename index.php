<?php
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script type='text/javascript' src='knockout-3.4.2.js'></script>
    <style>
        .starRating span {
            width: 24px;
            height: 24px;
            background-image: url(stars.png);
            display: inline-block;
            cursor: pointer;
            background-position: -24px 0;
        }
        .starRating span.chosen {
            background-position: 0 0;
        }
        .starRating span.hoverChosen {
            background-position: 0 0;
        }
    </style>
    <link rel="stylesheet" href="jquery-ui.css">
    <script
            src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>
    <script src="sammy.min.js"></script>
    <script src="jquery-ui.min.js"></script>
</head>
<body>
<h3 data-bind="text: question"></h3>
<p>Please distribute <b data-bind="text: pointsBudget"></b> points between the following options.</p>

<table>
    <thead><tr><th>Option</th><th>Importance</th></tr></thead>
    <tbody data-bind="foreach: answers">
    <tr>
        <td data-bind="text: answerText"></td>
        <td data-bind="starRating: points"></td>
    </tr>
    </tbody>
</table>

<h3 data-bind="fadeVisible: pointsUsed() > pointsBudget">You've used too many points! Please remove some.</h3>
<p>You've got <b data-bind="text: pointsBudget - pointsUsed()"></b> points left to use.</p>
<button data-bind="jqButton: {enable: pointsUsed() <= pointsBudget}, click: save">Finished</button>
<script type="text/javascript">
    function Answer(text) { this.answerText = text; this.points = ko.observable(1); }

    function SurveyViewModel(question, pointsBudget, answers) {
        ko.bindingHandlers.starRating = {
            init: function(element, valueAccessor){
                $(element).addClass('starRating');
                var observable = valueAccessor();
                for (var i = 0; i < 5; i++)
                    $("<span>").appendTo(element);
                $("span", element).each(function(index){
                    $(this).hover(
                        function() { $(this).prevAll().add(this).addClass("hoverChosen")},
                        function() { $(this).prevAll().add(this).removeClass("hoverChosen") }
                    ).click(function(){
                        var observable = valueAccessor();
                        observable(index + 1);
                    });
                });
            },
            update: function(element, valueAccessor) {
                var observable = valueAccessor();
                $("span", element).each(function(index) {
                    $(this).toggleClass("chosen", index < observable());
                });
            }
        },
        ko.bindingHandlers.jqButton = {
            init: function(element) {
                $(element).button();
            },
            update: function(element, valueAccessor) {
                var currentValue = valueAccessor();
                $(element).button("option", "disabled", currentValue.enable === false);
            }
        },
        ko.bindingHandlers.fadeVisible = {
            init: function(element, valueAccessor) {
                var shouldDisplay = valueAccessor();
                $(element).toggle(shouldDisplay);
            },
            update: function(element, valueAccessor) {
                var shouldDisplay = valueAccessor();
                shouldDisplay ? $(element).fadeIn() : $(element).fadeOut();
            }
        }
        this.question = question;
        this.pointsBudget = pointsBudget;
        this.answers = $.map(answers, function(text) { return new Answer(text) });
        this.save = function() { alert('To do') };

        this.pointsUsed = ko.computed(function() {
            var total = 0;
            for (var i = 0; i < this.answers.length; i++)
                total += this.answers[i].points();
            return total;
        }, this);
    }

    ko.applyBindings(new SurveyViewModel("Which factors affect your technology choices?", 10, [
        "Functionality, compatibility, pricing - all that boring stuff",
        "How often it is mentioned on Hacker News",
        "Number of gradients/dropshadows on project homepage",
        "Totally believable testimonials on project homepage"
    ]));
</script>
</body>
</html>
