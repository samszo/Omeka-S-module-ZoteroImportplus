<?php
// Warning: the mapping is not one-to-one, so some data may be lost when the
// mapping is reverted. You may adapt it to your needs.

// https://www.zotero.org/support/kb/item_types_and_fields#item_types
return [
    'artwork'             => 'bibo:Image',
    'attachment'          => 'bibo:Document',
    'audioRecording'      => 'bibo:AudioDocument',
    'bill'                => 'bibo:Bill',
    'blogPost'            => 'bibo:Article',
    'book'                => 'bibo:Book',
    'bookSection'         => 'bibo:BookSection',
    'case'                => 'bibo:LegalCaseDocument',
    'computerProgram'     => 'bibo:Document',
    'conferencePaper'     => 'bibo:Article',
    'dictionaryEntry'     => 'bibo:Article',
    'document'            => 'bibo:Document',
    'email'               => 'bibo:Email',
    'encyclopediaArticle' => 'bibo:Article',
    'film'                => 'bibo:Film',
    'forumPost'           => 'bibo:Article',
    'hearing'             => 'bibo:Hearing',
    'instantMessage'      => 'bibo:PersonalCommunication',
    'interview'           => 'bibo:Interview',
    'journalArticle'      => 'bibo:AcademicArticle',
    'letter'              => 'bibo:Letter',
    'magazineArticle'     => 'bibo:Article',
    'manuscript'          => 'bibo:Manuscript',
    'map'                 => 'bibo:Map',
    'newspaperArticle'    => 'bibo:Article',
    'note'                => 'bibo:Note',
    'patent'              => 'bibo:Patent',
    'podcast'             => 'bibo:AudioDocument',
    'presentation'        => 'bibo:Slideshow',
    'radioBroadcast'      => 'bibo:AudioDocument',
    'report'              => 'bibo:Report',
    'statute'             => 'bibo:Statute',
    'tvBroadcast'         => 'bibo:AudioVisualDocument',
    'thesis'              => 'bibo:Thesis',
    'videoRecording'      => 'bibo:AudioVisualDocument',
    'webpage'             => 'bibo:Webpage',
    //ajout samszo
    'concept'             => 'skos:Concept',
    'person'              => 'foaf:Person',    
    'user'                => 'jdc:Actant',
    'annotation'          => 'oa:Annotation',
    //fin ajout
];
