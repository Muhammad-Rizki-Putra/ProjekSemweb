use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

Route::get('/kamus', function (Request $request) {
    $word = $request->query('word');

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

    $response = Http::get('http://localhost:3030/#/dataset/djawa-db/query', [
        'query' => $sparqlQuery,
        'format' => 'application/sparql-results+json'
    ]);

    return $response->json();
});
