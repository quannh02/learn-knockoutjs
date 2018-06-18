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
<h2>Your seat reservations</h2>

<table>
    <thead>
    <tr>
        <th>Passenger name</th>
        <th>Meal</th>
        <th>Surcharge</th>
        <th></th>
    </tr>
    </thead>
    <!-- Todo: Generate table body -->
    <tbody data-bind="foreach: seats">
    <tr>
        <td><input data-bind="text: name"/></td>
        <td><select data-bind="options: $root.availableMeals, value: meal, optionsText: 'mealName'"></select></td>
        <td data-bind="text: formattedPrice"></td>
        <td><a href="#" data-bind="click: $root.removeSeat">Remove</a></td>
    </tr>
    </tbody>
</table>
<h3 data-bind="visible: totalSurcharge() > 0">
    Total surcharge: $<span data-bind="text: totalSurcharge().toFixed(2)"></span>
</h3>
<button data-bind="click: addSeat, enable: seats().length < 5">Reserve another seat</button>
<script type="text/javascript">
    function SeatReservation(name, initialMeal) {
        var self = this;
        self.name = name;
        self.meal = ko.observable(initialMeal);
        self.formattedPrice = ko.computed(function(){
            var price = self.meal().price;
            return price ? "$" + price.toFixed(2) : "None";
        });
    }


    function ReservationsViewModel() {
        var self = this;

        self.availableMeals = [
            {mealName: "Standard (sandwich)", price: 0},
            {mealName: "Premium (lobster)", price: 34.95},
            {mealName: "Ultimate (whole zebra)", price: 290}
        ];

        self.seats = ko.observableArray([
            new SeatReservation('Steve', self.availableMeals[0]),
            new SeatReservation('Bob', self.availableMeals[1])
        ]);

        self.addSeat = function(){
            self.seats.push(new SeatReservation('', self.availableMeals[0]));
        };
        self.removeSeat = function(seat) { self.seats.remove(seat) }

        self.totalSurcharge = ko.computed(function(){
            var total = 0;
            for(var i = 0; i < self.seats().length; i++){
                total += self.seats()[i].meal().price;
            }
            return total;
        });
    }
    ko.applyBindings(new ReservationsViewModel());
</script>
</body>
</html>
