<?php

$type = $_REQUEST['folder'];

$mailId = $_REQUEST['mailId'];

if ($type) {
    switch ($type) {
        case 'Inbox' :
            echo '{ "id":"Inbox", "mails": [{ "folder":"Inbox", "id": 1, "from": 15, "to": 33, "subject": 5, "date": 55}]}';
            break;
        case 'Archive':
            echo '{"id":"Archive", "mails": [{"folder":"Inbox",  "id": 2, "from": 20, "to": 20, "subject": 5, "date": 55}]}';
            break;
        default:
            echo '{"id":"Sent", "mails": [{"folder":"Inbox", "id": 3, "from": 10, "to": 10, "subject": 5, "date": 55}]}';
            break;
    }
}

if ($mailId) {
    echo '{"id":1,"from":"Abbot \u003coliver@smoke-stage.xyz\u003e","to":"steve@example.com","date":"May 25, 2011","subject":"Booking confirmation #389629244","messageContent":"Hi!\u003cbr/\u003e\u003cbr/\u003eSchwebet und ernsten zu ich träne diesmal schatten ich folgenden erste seh jenem und irrt was menge dunst herauf. Jenem meinem die mich bang jenem den lebens das busen verklungen fühlt folgenden. Stunden folgenden um nach widerklang strenge ein welt ich euch alten der um nun erfreuet gedränge. Festzuhalten bilder mich ihr jenem mit verklungen auf euch wird selbst des noch weich an des. Tränen um sehnen gleich das stunden irrt einst ertönt besitze ein und liebe wohl noch manche und hinweggeschwunden ertönt.\u003cbr/\u003e\u003cbr/\u003eLied lieb zauberhauch erste die steigen fühlt mich liebe halbverklungnen zu selbst liebe glück. Mir es fühlt hinweggeschwunden schwebet nun euch glück auf irrt neu weiten fühlt und jenem bringt lebens versuch. Erste folgenden ich walten wird euren sang nicht lebt mit es steigt widerklang tönen nun busen.\u003cbr/\u003e\u003cbr/\u003eGesänge zu nun hinweggeschwunden vom mich fühlt träne blick kommt zu. Um wohl es freundliche denen geneigt wird. Menge hören zauberhauch vom ertönt wiederholt mich die nicht jenem euch ein.\u003cbr/\u003e\u003cbr/\u003eWiderklang der lebens der zug träne selbst sich bilder alten strenge zerstoben zauberhauch die um. Ertönt versuch erfreuet und. Ein wieder zerstreuet zerstoben folgt ich herzen der kommt ihr mein sich ersten gedränge.\u003cbr/\u003e\u003cbr/\u003eBest regards - Jonas","folder":"Inbox"}';
}

