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

<form data-bind="submit: addItem">
    New item:
    <input type="text" data-bind='value: itemToAdd, valueUpdate: "afterkeydown"'>
    <button type="submit" data-bind="enable: itemToAdd().length > 0">Add</button>
    <p>Your items: </p>
    <select multiple="multiple" width="50" data-bind="options: items"></select>
</form>
The name is <span data-bind="text: fullName"></span>

<script type='text/javascript'>
    var SimpleListModel = function(items) {
        var self = this;

        self.items = ko.observableArray(items);
        self.itemToAdd = ko.observable("");
        self.addItem = function(){
            if(self.itemToAdd != ""){
                self.items.push(self.itemToAdd());
                self.itemToAdd('');
            }
        }.bind(this);
        self.firstName = ko.observable('Quan');
        self.lastName = ko.observable('Nguyen');
        self.fullName = ko.computed(function(){
            return self.firstName() + " "  + self.lastName();
        }.bind(self));
    }
    ko.applyBindings(new SimpleListModel(["abcc", "aklsjg", "sgajsdlkj"]));
</script>
</body>
</html>
