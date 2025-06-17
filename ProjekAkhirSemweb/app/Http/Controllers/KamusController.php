<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class KamusController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function search(Request $request)
    {
        $word = $request->input('word');

        $sparqlQuery = <<<SPARQL
PREFIX : <http://example.org/kamus-jawa-kuno/data/>
PREFIX kjk: <http://example.org/kamus-jawa-kuno/schema#>
PREFIX skos: <http://www.w3.org/2004/02/skos/core#>
PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
PREFIX dcterms: <http://purl.org/dc/terms/>
PREFIX lexinfo: <http://www.lexinfo.net/ontology/2.0/lexinfo#>

SELECT ?oldJavaneseForm
WHERE {
  ?entry a skos:Concept ;
         rdfs:label "{$word}"@id ;
         kjk:hasOldJavaneseEquivalent ?equivalent .
         
  ?equivalent kjk:oldJavaneseForm ?oldJavaneseForm .
}
SPARQL;

        $response = Http::get('http://localhost:3030/jawa-db/sparql', [
            'query' => $sparqlQuery,
            'format' => 'application/sparql-results+json'
        ]);

        $results = $response->json()['results']['bindings'] ?? [];

        return view('welcome', [
            'word' => $word,
            'results' => $results
        ]);
    }
}
