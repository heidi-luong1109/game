 <!DOCTYPE html>
<html>
<head>
    <title>{{ $game->title }}</title>
    <meta charset="utf-8">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui">
      <style>
         body,
         html {
         position: fixed;
         } 
      </style>
   </head>



<body style="margin:0px;width:100%;background-color:black;overflow:hidden">



<iframe id='game' style="margin:0px;border:0px;width:100%;height:100vh;" src='/games/OceanRulerSW/fufishdeluxe/335/index.html?startGameToken=eyJhbGciOiJIUzUxMiIsInR5cCI6IkpXVCJ9.eyJwbGF5ZXJDb2RlIjoicGxheWVyMTU4OTAyMzc0Mzc5MCIsImJyYW5kSWQiOjE1MCwiZ2FtZUNvZGUiOiJzd19vciIsInByb3ZpZGVyQ29kZSI6IlNXIiwicHJvdmlkZXJHYW1lQ29kZSI6InN3X29yIiwiY3VycmVuY3kiOiJDTlkiLCJwbGF5bW9kZSI6ImZ1biIsImVudklkIjoiZ3MzIiwidGVzdCI6dHJ1ZSwiaWF0IjoxNTg5MDIzNzQzLCJleHAiOjE1ODkwMzA5NDMsImlzcyI6InNreXdpbmRncm91cCJ9.U8HWplO6sTYptMwrro4U1hhHwYyYILDIH58gze1HGQsxPNJeA1ThZbNY-cSUvKfsTVPrPG-Ph5tEg_7AEAqnMQ&url=656&swa=0&history=0&history_url=&hide_play_for_real=true&phantom_version_host=&language=en' allowfullscreen>


</iframe>




</body>
<script rel="javascript" type="text/javascript" src="/games/{{ $game->name }}/device.js"></script>
<script rel="javascript" type="text/javascript" src="/games/{{ $game->name }}/addon.js"></script>
</html>

