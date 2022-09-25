<?php

use Illuminate\Support\Facades\DB;

?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>@yield('title')</title>

      <!-- Fonte do Google -->
      <link href="https://fonts.googleapis.com/css2?family=Roboto" rel="stylesheet">

      <!-- CSS Bootstrap -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        
      <!-- CSS Slider -->
      <!-- CSS ICONS --> 
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

      <style type="text/css">

      * {
        font-family: Helvetica;
        padding: 0;
        margin: 0;
        box-sizing: border-box;
      }

      body {
        padding: 1rem;
      }

      h1 {
        margin-bottom: 1rem;
      }

      button {
        padding: 0.6rem 1.2rem;
        background-color: #888;
        color: #fff;
        border: none;
        border-radius: 0.25rem;
        cursor: pointer;
        opacity: 0.9;
        font-size: 1rem;
      }

      #open-modal {
        background-color: #007bff;
      }

      button:hover {
        opacity: 1;
      }

      #fade {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        z-index: 5;
      }

      #modal {
        position: fixed;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: 500px;
        max-width: 90%;
        background-color: #fff;
        padding: 1.2rem;
        border-radius: 0.5rem;
        z-index: 10;
      }

      #fade,
      #modal {
        transition: 0.5s;
        opacity: 1;
        pointer-events: all;
      }

      .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #ccc;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
      }

      .modal-body p {
        margin-bottom: 1rem;
      }

      #modal.hide,
      #fade.hide {
        opacity: 0;
        pointer-events: none;
      }

      #modal.hide {
        top: 0;
      }


      </style>
      
      <!-- CSS da aplicação -->
      <link rel="stylesheet" href="/css/styles.css">
    
      <script src="/js/scripts.js"></script>
      
      <!-- jquery -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.2/chosen.jquery.min.js"></script>

      <!-- Latest compiled and minified JavaScript -->
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
    </head>
    <body>
      <main>
        <div class="container-fluid">
          <div class="row">
            @yield('content')
          </div>
        </div>
      </main>
      <script src="https://unpkg.com/ionicons@5.1.2/dist/ionicons.js"></script>
    </body>
</html>

