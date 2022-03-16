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
    <link rel="stylesheet" href="/css/headerCel.css">
    <link rel="stylesheet" href="/css/dashboardCel.css">
    <link rel="stylesheet" href="/css/editStatus.css">
    <link rel="stylesheet" href="/css/pedidoCel.css">
    <link rel="stylesheet" href="/css/clienteCel.css">
    {{-- 
    <link rel="stylesheet" href="/css/form.css">
    
    <link rel="stylesheet" href="/css/prato.css">
    <link rel="stylesheet" href="/css/cliente.css">
    <link rel="stylesheet" href="/css/pedido.css">
    <link rel="stylesheet" href="/css/containers.css">
    <link rel="stylesheet" href="/css/admin.css">
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/filter.css"> --}}
    
    
    <style>
        
        *{
            font-family: 'Nunito', sans-serif;
        }
        main{
            width: 100%;
            padding-top:30px;
            height: 100vh;
            overflow-x: hidden
        }
        ul{
            padding: 0px
        }
        :root{
            /*Paleta de cores
            ['#211e19','#073f5a','#b1d7a8','#55725c','#eae8ed','#063045','#D0CDD4']
            */
            --preto:#1e1b16;
            --azulescuro:#247593;
            --azul:#4c889e;
            --azulclaro:#8fbed0;
            --azulmaisclaro: #c0dae0;
            --verdeclaro:#8cb27f;
            --verdeescuro:#55725c;
            --branco: #eae8ed;
            --brancoclaro: #f0f0f0; 
            --brancoescuro:#d0cdd4;  
            --cinzaBrancoIOS: #f3f2f7;
            --cinzaIOS: #e4e3e8;
            --brancoIOS: #FFFFFF;
            --letraIOS: #76757be0;
            --bordaIOS:#d3d1db;

        }
        #msg{
            width: calc(100%- 30px);
            height: fit-content;           
            margin: 10px;
            padding: 5px;
            text-align: center;
            color: var(--preto);
        }
        .BCverdeClaro{
            background-color: var(--verdeclaro);
        }
        .BCbranco{
            background-color: var(--brancoIOS);
        }
        .borderRadius{
            border-radius: 10px;
        }
        .sombra{
            box-shadow: 0px 5px 10px rgba(211, 211, 211, 0);
            animation: shadow 200ms ease-in 800ms forwards;
        }
        @keyframes shadow{
            from{
                box-shadow: 0px 5px 10px rgba(211, 211, 211, 0);
            }
            to{
                box-shadow: 0px 5px 10px rgb(211, 211, 211);
            }
        }
        body{
            background-color: var(--cinzaBrancoIOS);
            overflow-x: hidden
            
        }
        .inputCustom{
            border: none;
            border-bottom: 1px solid #ced4da;
            background-color: transparent;
            outline: none;
            margin-bottom: 10px;
            width: 300px;
        }
        .TituloPadraoConfig {
            width: 100%;
            text-align: left;
            color: var(--letraIOS);
            margin-left: 10px;
        }

        .CardForm{
            padding:10px;
            width: 93%;
        }
        .marginTopBottom{
            margin: 10px 0px 10px 0px
        }
        .hidden{
            display: none;
            visibility: hidden;
            height: 0px;
        }
        .flexCloumn{
            display: flex;
            flex-direction: column;
        }
        .CemPorCento{
            width: 100%;
            height: 100%;
        }

        @media only screen and (max-width: 760px) {
            .inputCustom{
                width: 100% ;
            }
            .labelCustom{
                width: 100%
            }
            .SelectCustom{
                outline: none;
                padding: 5px;
                border: 1px solid var(--bordaIOS);
                transition: 100ms;
            }
            .SelectCustom:focus{
                border: 2px solid var(--bordaIOS)
            }
            .SelectCustom:active{
                border: 2px solid var(--bordaIOS)
            }
            .SelectCustom:hover{
                border: 2px solid var(--bordaIOS)
            }
            .Center{
                display: flex;
                align-items: center;
                justify-content: center;
                width: 100%; 
            }
        }
        
        
        
    </style>
    
</head>
<body>
    <header>
        <div class="BCDROP">
            <div  class="menuHidden headerOptions">
                <ul>
                    <li><a id='a' href="/"><ion-icon name="home-outline"></ion-icon></a></li>
                    <li><a id='a' href="/prato">Criar prato do dia</a></li>
                    <li><a id='a' href="/Pedidos/create">Criar pedido</a></li>
                    <li><a id='a' href="/cliente/criar">Criar cliente</a> </li>
                    @if(Auth::user()->staff == 'Admin' || Auth::user()->staff == 'Desenvolvedor')
                    <li><a id='a' href="/admin"> Administrador</a></li>
                    @endif
                </ul>
            </div>
            <div id="profileArea">
                <div class="arrowDown" id="seta"><ion-icon name="caret-down-outline"></ion-icon></div>
            </div>
        </div>
    </header>
    <main>
        
        
        
        @if(session('msg'))
            <div id="msg" class="borderRadius sombra">
                {{session('msg')}}
            </div>
        @endif
        @yield('content')
    </main>    
    {{--<footer>
        footer
    </footer>--}}
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script>
        
        let profileArea = document.getElementById('profileArea')
        profileArea.addEventListener('click',handleMenuDrop)

        function handleMenuDrop(){
            let irmao = this.previousElementSibling
            let seta = document.getElementById('seta')

            let verifica = [... irmao.classList].indexOf('menuHidden') > -1 ? mostraMenu(irmao,seta) : escondeMenu(irmao,seta)
        }
        

        function mostraMenu(menu, seta){
            seta.classList.remove('arrowDown')
            seta.classList.add('arrowUp')

            menu.classList.remove('menuHidden')
            menu.classList.add('menuShow')
        }
        function escondeMenu(menu, seta){
            seta.classList.remove('arrowUp')
            seta.classList.add('arrowDown')

            menu.classList.remove('menuShow')
            menu.classList.add('menuHidden')
        }
    </script>
</body>
</html>