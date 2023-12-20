<?php
session_set_cookie_params(['HttpOnly' => true, 'Secure' => true]);
session_start();
if ($_SESSION['query'] !="Admin"){
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) )
{

  header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
  die ("<h2>Access Denied!</h2> This file is protected and not available to public.");
}
}
?>

<html>
<head>
    <title>Descrierea tabelelor din baza de date a firmei de transport cu camioane</title>
</head>
<body>
    <h1>Tabela "Clienti"</h1>
    <p>
        Tabela "Clienti" conține informații despre clienții companiei de transport cu camioane. Aici sunt stocate următoarele câmpuri:
    </p>
    <ul>
        <li><strong>ID_Client:</strong> Cheia primară unică pentru fiecare client.</li>
        <li><strong>Nume_Client:</strong> Numele clientului.</li>
        <li><strong>Adresa:</strong> Adresa clientului.</li>
        <li><strong>Număr de telefon:</strong> Numărul de telefon al clientului.</li>
        <li><strong>E-mail:</strong> Adresa de e-mail a clientului.</li>
        <li><strong>Alte informații:</strong> Alte detalii sau informații relevante despre client.</li>
    </ul>

    <h1>Tabela "Camioane"</h1>
    <p>
        Tabela "Camioane" stochează informații despre camioanele utilizate în activitatea de transport a companiei. Aceasta conține următoarele câmpuri:
    </p>
    <ul>
        <li><strong>ID_Camion:</strong> Cheia primară unică pentru fiecare camion.</li>
        <li><strong>ID_Sofer:</strong> Cheia străină care leagă comanda de client în tabela "Soferi".</li>
        <li><strong>Număr de înmatriculare:</strong> Numărul de înmatriculare al camionului.</li>
        <li><strong>Model:</strong> Modelul camionului.</li>
        <li><strong>An de fabricație:</strong> Anul de fabricație al camionului.</li>
        <li><strong>Capacitate de încărcare:</strong> Capacitatea maximă de încărcare a camionului.</li>
        <li><strong>Alte informații:</strong> Alte detalii despre camion, cum ar fi starea tehnică sau reviziile efectuate.</li>
    </ul>

    <h1>Tabela "Soferi"</h1>
    <p>
        Tabela "Soferi" conține informații despre șoferii angajați pentru conducerea camioanelor. Aceasta conține următoarele câmpuri:
    </p>
    <ul>
        <li><strong>ID_Sofer:</strong> Cheia primară unică pentru fiecare șofer.</li>
        <li><strong>ID_Camion:</strong> Cheia străină care leagă comanda de client în tabela "Camion".</li>
        <li><strong>Nume:</strong> Numele șoferului.</li>
        <li><strong>CNP:</strong> Codul Numeric Personal al șoferului.</li>
        <li><strong>Număr de telefon:</strong> Numărul de telefon al șoferului.</li>
        <li><strong>Alte informații:</strong> Alte detalii despre șofer, cum ar fi experiența în conducerea camioanelor.</li>
    </ul>

    <h1>Tabela "Rute"</h1>
    <p>
        Tabela "Rute" definește traseele disponibile pentru transport, inclusiv punctele de plecare și destinație, distanța și timpul estimat de livrare. Aceasta conține următoarele câmpuri:
    </p>
    <ul>
        <li><strong>ID_Ruta:</strong> Cheia primară unică pentru fiecare rută.</li>
        <li><strong>Plecare:</strong> Locul de plecare al rutei.</li>
        <li><strong>Destinație:</strong> Locul de destinație al rutei.</li>
        <li><strong>Distanța:</strong> Distanța totală a rutei.</li>
        <li><strong>Timp estimat de livrare:</strong> Timpul estimat necesar pentru a parcurge ruta.</li>
        <li><strong>Alte informații:</strong> Alte detalii despre ruta, cum ar fi restricțiile de trafic sau tipul de marfă transportată.</li>
    </ul>

    <h1>Tabela "Comenzi"</h1>
    <p>
        Tabela "Comenzi" este folosită pentru a înregistra informații despre comenzile efectuate de clienți. Aceasta conține următoarele câmpuri:
    </p>
    <ul>
        <li><strong>ID_Comanda:</strong> Cheia primară unică pentru fiecare comandă.</li>
        <li><strong>ID_Client:</strong> Cheia străină care leagă comanda de client în tabela "Clienti".</li>
        <li><strong>ID_Ruta:</strong> Cheia străină care leagă comanda de ruta în tabela "Rute".</li>
        <li><strong>Data comandă:</strong> Data la care a fost plasată comanda.</li>
        <li><strong>Data de livrare programată:</strong> Data planificată pentru livrarea comenzii.</li>
        <li><strong>Stare comandă:</strong> Starea comenzii (cum ar fi "în așteptare", "în curs de livrare", "livrată", etc.).</li>
        <li><strong>Alte informații:</strong> Alte detalii despre comandă, cum ar fi produsele sau cantitatea solicitată.</li>
    </ul>

    <h1>Tabela "Facturi"</h1>
    <p>
        Tabela "Facturi" este folosită pentru a înregistra informații despre facturile generate pentru comenzile clienților. Aceasta conține următoarele câmpuri:
    </p>
    <ul>
        <li><strong>ID_Factura:</strong> Cheia primară unică pentru fiecare factură.</li>
        <li><strong>ID_Comanda:</strong> Cheia străină care leagă factura de comanda în tabela "Comenzi".</li>
        <li><strong>Data facturării:</strong> Data la care a fost emisă factura.</li>
        <li><strong>Suma totală:</strong> Valoarea totală a facturii.</li>
        <li><strong>Stare plată:</strong> Starea plății (cum ar fi "neplătită", "parțial plătită", "plătită").</li>
        <li><strong>Alte informații:</strong> Alte detalii despre factură, cum ar fi termenul de plată sau metoda de plată acceptată.</li>
    </ul>

    <h1>Relațiile dintre Tabele</h1>

<h2>Clienti și Comenzi</h2>
<p>Tabela "Comenzi" este legată de tabela "Clienti" printr-o cheie străină (<strong>ID_Client</strong>), ceea ce permite identificarea clientului pentru fiecare comandă.</p>

<h2>Rute și Comenzi</h2>
<p>Tabela "Comenzi" este legată de tabela "Rute" printr-o cheie străină (<strong>ID_Ruta</strong>), ceea ce permite specificarea rutei pentru fiecare comandă.</p>

<h2>Clienti și Facturi</h2>
<p>Tabela "Facturi" este legată de tabela "Comenzi" printr-o cheie străină (<strong>ID_Comanda</strong>), iar tabela "Comenzi" este legată de tabela "Clienti" printr-o cheie străină (<strong>ID_Client</strong>), astfel încât fiecare factură să fie asociată cu un client specific.</p>

<h2>Camioane și Soferi</h2>
<p>Tabela "Camioane" este legată de tabela "Soferi" printr-o cheie străină (<strong>ID_Sofer</strong>), iar tabela "Soferi" este legată de tabela "Camioane" printr-o cheie străină (<strong>ID_Camion</strong>), astfel încât fiecare camion să fie asociat unui sofer.</p>

<h1>Arhitectura aplicației</h1>

    <h2>Front-end și Back-end (Full-stack PHP)</h2>
    <p>Roluri:</p>
    <ul>
        <li>Utilizatorul</li>
    </ul>
    <p>Entități:</p>
    <ul>
        <li>Interfața de autentificare (formular de login)</li>
        <li>Interfața pentru gestionarea comenzilor și facturilor (după autentificare)</li>
    </ul>
    <p>Procese:</p>
    <ul>
        <li>Autentificarea utilizatorului</li>
        <li>Afișarea datelor comenzilor și facturilor</li>
    </ul>

    <h2>Baza de date</h2>
    <p>Roluri:</p>
    <ul>
        <li>Baza de date</li>
    </ul>
    <p>Entități:</p>
    <ul>
        <li>Tabelele "Clienti," "Comenzi," "Facturi" și altele relevante</li>
    </ul>
    <p>Procese:</p>
    <ul>
        <li>Stocarea și gestionarea datelor în tabelele respective</li>
    </ul>

    <h1>Soluția de Implementare Propusă</h1>

    <h2>Front-end și Back-end (Full-stack PHP)</h2>
    <p>Interfața de autentificare va fi creată folosind HTML și CSS, cu cod PHP pentru procesarea datelor și a cererilor.</p>
    <p>După autentificare, datele despre comenzile și facturile utilizatorului vor fi afișate într-o interfață grafică folosind HTML, CSS și PHP.</p>

    <h2>Baza de date</h2>
    <p>Baza de date va fi creată și gestionată cu ajutorul unui sistem de gestionare a bazelor de date (mysql).</p>
    <p>Tabelele (Clienti, Comenzi, Facturi) vor fi definite pentru a stoca datele corespunzătoare.</p>
</body>

</body>
</html>

<style type="text/css">
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        h1 {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        p {
            margin: 20px;
            padding: 10px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px;
        }

        table, th, td {
            border: 1px solid #333;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        ul {
            list-style-type: square;
            margin: 20px;
            padding: 0;
        }

        li {
            margin-bottom: 5px;
        }
    </style>
