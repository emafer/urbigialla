temaScuola
==========


Modifiche Plugin Vendor
=======================

PA FACILE
==============
**file:** pafacile/tosendit.php
**Riga 343:** aggiunto parametro $scaduto, di default a false 
```
static function displayFileUploadBox($table, $id, $scaduto = false){
```
**Riga 386:** sostituito il link iniziale con un controllo: se scaduto è true allora non mostro  il link
```
<?php if (!$scaduto)
{ ?> <a href="<?php echo($row->file_url); ?>" ><?php echo(($row->titolo!=''&& $row->titolo!=null)?$row->titolo:basename($row->file_url) ); ?> </a> <?php }
else
{ echo(($row->titolo!=''&& $row->titolo!=null)?$row->titolo:basename($row->file_url) ) . ' (documento archiviato)';}
?>
```
**file:** pafacile/AlboPretorio.php
**Riga 456:** Introdotto controllo sulla data di scadenza del documento. Se scaduto richiamo la funzione `displayFileUploadBox` 
 con il parametro $scaduto a true  
```
<!-- <?php 
   $dataScadenza = new DateTime($rs->pubblicata_al);
   if ($dataScadenza < new DateTime() )
   { $scaduto = true; }
   else
   { $scaduto = false; }
   ?> -->
   <?php 
   toSendItGenericMethods::displayFileUploadBox($tableName, $rs->id, $scaduto);
   ?>
```

ANAC XML AVCP
======================

In generale: invece di ``' . site_url() . '/avcp/`` usare 
``    <a href="' . site_url() . '/avcp/trasparenza/'. get_current_blog_id() .'/2014.xml' . '" target="_blank">2014</a> &bull;
``
Invece di `` ABSPATH . 'avcp`` usare
``ABSPATH . 'avcp/trasparenza/'. get_current_blog_id() .``
**file:** avcp_valid_check.php
**Riga 9** cambiato riferimento alla posizione del file
```
$xml->load(ABSPATH . 'avcp/trasparenza/'. get_current_blog_id() .'/' . $term->name. '.xml');
```

**File:** valid_page.php
**Righe: 33 e ss** 

**File:** avcp_index_generator.php
**Righe 21,25,32** Cambiare i riferimenti al file

**File:** avcp_xml_generator.php
**Righe: 27, 142** Cambiare i riferimenti al file

**File:** avcp.php
**Riga: 54** rimosso il supporto editor, per inserire solo i dati utili e non la descrizione della gara

**File:** alerts.php
**Riga: 55** Cambiare i riferimenti al file

**File:** include/avcp_functions.js (modifiche per evitare degli errori di compilazione)

