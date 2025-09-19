<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Chave da API Gemini
    |--------------------------------------------------------------------------
    |
    | Defina a chave da API Gemini no seu arquivo .env como GEMINI_API_KEY.
    | Esta chave será usada para autenticação nas chamadas da API do Google.
    |
    */

    'api_key' => env('GEMINI_API_KEY'),

    'model' => env('GEMINI_MODEL', 'gemini-1.5-flash'),

    // URL base para a API de geração de texto
    'base_url' => 'https://generativelanguage.googleapis.com/v1beta/models',

    // URL base para a API de geração de imagens (Vertex AI / Imagen)
    'image_base_url' => 'https://'. env('GOOGLE_CLOUD_LOCATION') . '-aiplatform.googleapis.com/v1/projects/' . env('GOOGLE_CLOUD_PROJECT_ID') . '/locations/' . env('GOOGLE_CLOUD_LOCATION') . '/publishers/google/models/imagen-v1',

    // Adicione a nova chave para o ID do projeto no Google Cloud
    'google_cloud_project_id' => env('GOOGLE_CLOUD_PROJECT_ID'),
    'google_cloud_location' => env('GOOGLE_CLOUD_LOCATION', 'us-central1'),
];
