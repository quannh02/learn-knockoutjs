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
        .folders {
            background-color: #bbb;
            list-style-type: none;
            padding: 0;
            margin: 0;
            border-radius: 7px;
            background-image: -webkit-gradient(linear, left top, left bottom, color-stop(0, #d6d6d6), color-stop(0.4, #c0c0c0), color-stop(1, #a4a4a4));
            margin: 10px 0 16px 0;
            font-size: 0px;
        }

        .folders li {
            font-size: 16px;
            font-weight: bold;
            display: inline-block;
            padding: 0.5em 1.5em;
            cursor: pointer;
            color: #444;
            text-shadow: #f7f7f7 0 1px 1px;
            border-left: 1px solid #ddd;
            border-right: 1px solid #888;
        }

        .folders .selected {
            background-color: #444 !important;
            color: white;
            text-shadow: none;
            border-right-color: #aaa;
            border-left: none;
            box-shadow: inset 1px 2px 6px #070707;
        }
    </style>
    <script
            src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>
</head>
<body>
<!-- Todo: Create UI -->
<ul class="folders" data-bind="foreach: folders">
    <li data-bind="text: $data, css: { selected: $data == $root.chosenFolderId() }, click: $root.goToFolder"></li>
</ul>
<!-- Mails grid -->
<table class="mails" data-bind="with: chosenFolderData">
    <thead>
    <tr>
        <th>From</th>
        <th>To</th>
        <th>Subject</th>
        <th>Date</th>
    </tr>
    </thead>
    <tbody data-bind="foreach: mails">
    <tr data-bind="click: $root.goToMail">
        <td data-bind="text: from"></td>
        <td data-bind="text: to"></td>
        <td data-bind="text: subject"></td>
        <td data-bind="text: date"></td>
    </tr>
    </tbody>
</table>
<!-- Chosen mail -->
<div class="viewMail" data-bind="with: chosenMailData">
    <div class="mailInfo">
        <h1 data-bind="text: subject"></h1>
        <p><label>From</label>: <span data-bind="text: from"></span></p>
        <p><label>To</label>: <span data-bind="text: to"></span></p>
        <p><label>Date</label>: <span data-bind="text: date"></span></p>
    </div>
    <p class="message" data-bind="html: messageContent" />
</div>
<script type="text/javascript">
    function WebmailViewModel() {
        // Data
        var self = this;
        self.folders = ['Inbox', 'Archive', 'Sent', 'Spam'];
        self.chosenFolderId = ko.observable();
        self.chosenMailData = ko.observable();
        self.chosenFolderData = ko.observable({mails: [{from: 10, to: 5, subject: 5, date: 55}]});
        self.goToFolder = function (folder) {
            self.chosenFolderId(folder);
            self.chosenMailData(null);
            $.get('/knockoutjs/mail.php', {folder: folder}, function (returnValue) {
                var obj = JSON.parse(returnValue);
                self.chosenFolderData(obj);
            });
        };
        self.goToMail = function(mail) {
            self.chosenFolderId(mail.folder);
            self.chosenFolderData(null);
            $.get("/knockoutjs/mail.php", { mailId: mail.id }, function (returnValue) {
                var obj = JSON.parse(returnValue);
                self.chosenMailData(obj);
            });
        };
        self.goToFolder('Inbox');
    };

    ko.applyBindings(new WebmailViewModel());
</script>
</body>
</html>
