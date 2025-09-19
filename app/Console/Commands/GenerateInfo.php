<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GenerateInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-info';

    protected $description = 'Extrai informações de personagens de tabelas em uma URL específica.';

    public function handle()
    {
        $url = 'https://leagueoflegends.fandom.com/wiki/Minor_Characters/Bandle_City';

        try {
            $html = Http::get($url)->body();
        } catch (\Exception $e) {
            $this->error("Erro ao acessar a URL: " . $e->getMessage());
            return;
        }

        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();
        $xpath = new \DOMXPath($dom);

        $tables = $xpath->query("//table[contains(@class, 'character-table')]");

        if ($tables->length === 0) {
            $this->warn('Nenhuma tabela de personagem encontrada. Verifique se a URL está correta e se a classe da tabela é "character-table".');
            return;
        }

        $allCharacters = [];

        foreach ($tables as $table) {
            $character = [];

            // 1. Extrair o nome do personagem (tr com font-size:1.5rem)
            $nameNode = $xpath->query(".//tr[th and contains(@style,'font-size:1.5rem')]/th")->item(0);
            $character['name'] = $nameNode ? trim($nameNode->textContent) : 'Nome não encontrado';

            // 3. Extrair características
            $characteristics = [];
            $charRows = $xpath->query(".//tr[td[starts-with(@style, 'padding:') and @colspan='1']]", $table);
            foreach ($charRows as $row) {
                $cells = $xpath->query(".//td", $row);
                foreach ($cells as $cell) {
                    $paragraphs = $xpath->query(".//p", $cell);
                    foreach ($paragraphs as $p) {
                        $parts = explode(':', trim($p->textContent), 2);
                        if (count($parts) === 2) {
                            $key = str_replace([':', ' '], '', $parts[0]);
                            $characteristics[$key] = trim($parts[1]);
                        }
                    }
                }
            }
            $character['characteristics'] = $characteristics;

            // 4. Extrair o background
            $backgroundNode = $xpath->query(".//tr[th[contains(text(),'Background')]]/following-sibling::tr[1]/td")->item(0);
            $character['background'] = $backgroundNode ? trim($backgroundNode->textContent) : null;

            // 5. Extrair Related Characters
            $relatedNodes = $xpath->query(".//td[p/span[contains(text(),'Related Characters')]]//a", $table);
            $character['related_characters'] = [];
            foreach ($relatedNodes as $node) {
                $character['related_characters'][] = trim($node->textContent);
            }

            // 6. Extrair Referenced Characters
            $referencedNodes = $xpath->query(".//td[p/span[contains(text(),'Referenced')]]//a", $table);
            $character['referenced_characters'] = [];
            foreach ($referencedNodes as $node) {
                $character['referenced_characters'][] = trim($node->textContent);
            }

            // $allCharacters[] = $character;

            $characterJson = json_encode($character, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            $prompt = "Baseado nessas informações faça um array com perguntas como o apresentado abaixo sobre o personagem e classifique o nivel de dificuldade da pergunta a partir de o quanto de conhecimento sobre o universo de league of legends provavelmente a pessoa deveria saber para conseguir responder. $characterJson. ['difficulty' => ['hard', 'medium', 'easy'],'region_id' => '','translations' => ['pt' => ['text' => '','correct_answer' => '','options' => ['', '', '', ''],],'en' => ['text' => '','correct_answer' => 'Boomer','options' => ['', '', '', ''],],],], E no caso region_id verifique a melhor relação da pergunta com as regiões mostradas ['id' => 1,'name' => 'Águas de Sentina'],['id' => 2,'name' => 'Bandópolis'],['id' => 3,'name' => 'Demacia'],['id' => 4,'name' => 'Freljord'],['id' => 5,'name' => 'Ilhas das Sombras'],['id' => 6,'name' => 'Ionia'],['id' => 7,'name' => 'Ixtal'],['id' => 8,'name' => 'Noxus'],['id' => 9,'name' => 'Piltover'],['id' => 10,'name' => 'Shurima'],['id' => 11,'name' => 'Targon'],['id' => 12, 'name' => 'Vazio'],['id' => 13,'name' => 'Zaun']. Na resposta gerada apenas me entregue o array e a justificativa das dificuldades e regiões:";

            try {
                $response = Http::withHeaders([
                    'Content-Type' => 'application/json',
                ])->post(config('gemini.base_url') . '/' . config('gemini.model') . ':generateContent?key=' . config('gemini.api_key'), [
                    'contents' => [
                        [
                            'parts' => [
                                ['text' => $prompt]
                            ]
                        ]
                    ]
                ]);

                if ($response->successful()) {
                    $text = $response['candidates'][0]['content']['parts'][0]['text'] ?? 'Erro: resposta inesperada da IA.';
                    dd([
                        'response' => $text,
                    ]);
                }

                dd([
                    'error' => 'Erro ao chamar a API Gemini: ' . $response->body(),
                ]);

            } catch (\Exception $e) {
                dd([
                    'error' => 'Erro ao chamar a API Gemini: ' . $e->getMessage(),
                ]);
            }
        }

        // $this->info("Extração concluída. " . count($allCharacters) . " personagens encontrados.");
        // $this->info(json_encode($allCharacters, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        }
}
