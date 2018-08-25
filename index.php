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
        .folders .selected {
            color: red;
        }
    </style>
    <script
            src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>
</head>
<body>
<ul class="folders" data-bind="foreach: folders">
    <li data-bind="text: $data, css: { selected : $data == $root.chosenFolderId() }, click: $root.goToFolder"></li>
</ul>
<table class="mails" data-bind="with: chosenFolderData">
    <thead><tr><th>From</th><th>To</th><th>Subject</th><th>Date</th></tr></thead>
    <tbody data-bind="foreach: mails">
        <tr>
            <td data-bind="text: from"></td>
            <td data-bind="text: to"></td>
            <td data-bind="text: subject"></td>
            <td data-bind="text: date"></td>
        </tr>
    </tbody>
</table>
<script type="text/javascript">
    function WebmailViewModel() {
        var self = this;
        self.folders = ['Inbox', 'Archive', 'Sent', 'Spam'];
        self.chosenFolderId = ko.observable();
        self.chosenFolderData = ko.observable();
        self.goToFolder = function(folder) {
            self.chosenFolderId(folder);
            $.get('/mail', { folder: folder }, self.chosenFolderData);
        };
        self.goToFolder('Inbox');
    };

    ko.applyBindings(new WebmailViewModel());
</script>
</body>
</html>
