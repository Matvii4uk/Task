<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <title>Страница А</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        button {
            margin: 5px 0;
            padding: 10px;
            font-size: 16px;
        }
        .result, .history {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<h1>Page A</h1>
<input type="hidden" name="gamblerId" value="{{$gambler->id}}" id="gamblerId">
<input type="hidden" name="slug" value="{{$link->slug}}" id="slug">

<button id="generateLink">Generate new link</button>
<button id="deactivateLink">Inactive current link</button>
<button id="imFeelingLucky">I'm feeling lucky</button>
<button id="history">History</button>

<div class="result" id="result"></div>
<div class="history" id="historyList"></div>

<script>
   $(document).ready(function() {
       $('#generateLink').click(function() {
           let gambler_id = $('#gamblerId').val();
           let baseURL = window.location.origin
           $.ajax({
               url: '/generate/' + gambler_id,
               type: 'GET',
               success: function(response) {
                   var newLink = document.createElement('a');
                   newLink.href = baseURL+'/link/'+response.slug+'/'+response.gambler_id;
                   newLink.textContent = "I'm new link. Click here! ";
                   var linkContainer = document.createElement('div');
                   linkContainer.appendChild(newLink);

                   $("#result").append(linkContainer);
               }
           });
       });

       $('#deactivateLink').click(function() {
           let slug = $('#slug').val();
           $.ajax({
               url: '/deactivate/'+slug,
               type: 'GET',
               success: function(response) {
                   alert(response.message);
                   window.location.href = '/';
               }
           });
       });

       $('#imFeelingLucky').click(function() {
           let gambler_id = $('#gamblerId').val();
           $.ajax({
               url: '/get-lucky/'+gambler_id,
               type: 'GET',
               success: function(response) {
                   alert(response.message+'! '+' Score: '+ response.score+ ', Amount: '+ response.amount);
               }
           });
       });

       $('#history').click(function() {
           let gambler_id = $('#gamblerId').val();
           $.ajax({
               url: '/history/'+gambler_id,
               type: 'GET',
               success: function(data) {
                   $("#historyList").empty();
                   $.each(data, function(index, value) {
                     let row = '<div>'+value.message+' - '+value.score+' - '+value.amount+'</div>';
                     $("#historyList").append(row);
                   });
               }
           });
       });
   });
</script>
</body>
</html>
