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

</head>
<body>

<!--<form data-bind="submit: addItem">-->
    New item:
<!--    <input type="text" data-bind='value: itemToAdd, valueUpdate: "afterkeydown"'>-->
<!--    <button type="submit" data-bind="enable: itemToAdd().length > 0">Add</button>-->
    <p>Your items: </p>
<!--    <select multiple="multiple" width="50" data-bind="options: items"></select>-->
</form>
<!--The name is <span data-bind="text: pureComputedFullName"></span>-->

<script type='text/javascript'>
    // var SimpleListModel = function(items) {
    //     var self = this;
    //
    //     self.items = ko.observableArray(items);
    //     self.itemToAdd = ko.observable("");
    //     self.addItem = function(){
    //         if(self.itemToAdd != ""){
    //             self.items.push(self.itemToAdd());
    //             self.itemToAdd('');
    //         }
    //     }.bind(this);
    //     self.pureComputedExecutions = 0;
    //     self.computedExecutions = 0;
    //     self.firstName = ko.observable('Quan');
    //     self.lastName = ko.observable('Nguyen');
    //     self.fullName = ko.pureComputed(function(){
    //         return self.firstName() + " "  + self.lastName();
    //     }.bind(self));
    //     self.fullNameComputed = ko.computed(function(){
    //         return self.firstName() + " "  + self.lastName();
    //     }.bind(self));
    // }
    // ko.applyBindings(new SimpleListModel(["abcc", "aklsjg", "sgajsdlkj"]));
    function ViewModel() {
        var self = this;

        self.firstName = ko.observable('Arshile');
        self.lastName = ko.observable('Gorky');
        self.pureComputedExecutions = 0;
        self.computedExecutions = 0;

        self.pureComputedFullName = ko.pureComputed(function() {
            // This is NOT recommended
            self.pureComputedExecutions++;
            return 'Hello ' + self.firstName() + ' ' + self.lastName();
        });
        self.computedFullName = ko.computed(function() {
            self.computedExecutions++;

            return 'Hello ' + self.firstName() + ' ' + self.lastName();
        });
    };
    var viewModel = new ViewModel();
    ko.applyBindings(viewModel);

    alert('Pure computed executions: ' + viewModel.pureComputedExecutions);
    alert('Computed executions: ' + viewModel.computedExecutions);
</script>
</body>
</html>
