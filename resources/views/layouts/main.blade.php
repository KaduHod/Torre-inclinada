<!DOCTYPE html>
<html lang ="pr-br">
<head>
    <meta charset = "UTF-8">

    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">

    <meta http-equiv = "X-UA-Compatible" content = "ie=edge">

    

    <title>@yield('title')</title>  
    

    <link rel  = "preconnect" href = "https://fonts.googleapis.com">
    <link rel  = "preconnect" href = "https://fonts.gstatic.com" crossorigin>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script> 

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <link href = "https://fonts.googleapis.com/css2?family=Nunito:wght@300&display=swap" rel="stylesheet">
    <link href="/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/footer.css">
    <link rel="stylesheet" href="/css/form.css">
    <link rel="stylesheet" href="/css/dashboard.css">
    <link rel="stylesheet" href="/css/prato.css">
    <link rel="stylesheet" href="/css/cliente.css">
    <link rel="stylesheet" href="/css/pedido.css">
    <link rel="stylesheet" href="/css/containers.css">
    <link rel="stylesheet" href="/css/admin.css">
    <link rel="stylesheet" href="/css/main.css">
    
    
    <style>
        
        
        

        *{
            font-family: 'Nunito', sans-serif;
            margin:0;
            padding:5;
            overflow-x: hidden;
            list-style: none;
        }
        a{
            text-decoration: none;
            overflow: hidden;
        }

        
        #a{
            color: rgb(255, 255, 255);
        }
        h3{
            overflow: hidden;
        }
        main h1{
            overflow: hidden;
        }
        body{
            display: flex;
            flex-direction: column;
            height: 100%;
            with: 100vw;
            
        }
        #msg{
            width: 100vw;
            height: 5vh;
            background-color: rgb(218, 230, 212);
            color: black;
            display: flex;
            justify-content: center;
            align-items: center;
            animation: fade-out 300ms ease-in 3000ms forwards ;
        }
        @keyframes fade-out{
            50%{
                color: rgba(218, 230, 212, 0)
            }
            100%{
                height: 0;
                color: rgba(218, 230, 212, 0)
            }
        }
        .add{
            width: 70px;
            height: 70px;
            background-image: url('/img/add.png');
            background-repeat: no-repeat;
            background-position: center;
            transition: 100ms;
            overflow: hidden;
        }
        .add:hover{
            transform: scale(1.1);
            
            
        }
        
    </style>
    
</head>
<body>
    <header>
        <div id="imageLogo">
            <img src="/img/torre.jpg" alt="" id='Logo'>
        </div>
        <div id="centerHeader">
            <ul>
                <li><a id='a' href="/prato">Criar prato do dia</a></li>
                <li><a id='a' href="/Pedidos/create">Criar pedido</a></li>
                <li><a id='a' href="/cliente/criar">Criar cliente</a> </li>
                <li><a id='a' href="/admin"> Admin page</a></li>
            </ul>
        </div>
        <div id="profileArea">
            <div>{{Auth::user()->name}}</div>
            <div id="seta"></div>
        </div>
    </header>
    <main>
        @if(session('msg'))
            <div id="msg">
                {{session('msg')}}
            </div>
        @endif
        @yield('content')
    </main>    
    {{--<footer>
        footer
    </footer>--}}
    
    <script>
        document.getElementById('Logo').addEventListener('click',()=>{
            window.location.replace('http://localhost:8000/dashboard')
        },false)
       
    </script>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>