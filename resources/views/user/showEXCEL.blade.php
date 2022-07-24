<head>
<style>

    *{margin:0; padding: 0; box-sizing: border-box;}

    .content{display:flex; margin: auto;}
    
    .cabecalho{
        text-align: left;
        width: 70%;
    }

    .rTable{width: 100%; text-align: center;}
        .rTable thead{background: black; font-weight: bold; color:#fff;}
        .rTable tbody tr:nth-child(2n){background: #ccc;}
        .rTable th , .rTable td{padding: 7px 0;}
    
    @media screen and (max-width: 480px){
        .content{width: 94%;}
    
        .rTable thead{display:none;}
        .rTable tbody td{display: flex; flex-direction: column; }
    }

    .container{
        width: 100vw;
        height: 100vh;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
    
    }
    h3{
        text-align: center; 
    }
    
    @media only screen and (min-width: 1200px){
        .content{width:100%;}
        .rTable tbody tr td:nth-child(1){width:10%;}
        .rTable tbody tr td:nth-child(2){width:30%;}
        .rTable tbody tr td:nth-child(3){width:20%;}
        .rTable tbody tr td:nth-child(4){width:10%;}
        .rTable tbody tr td:nth-child(5){width:30%;}
    }
</style>
<script src="/js/table2excel.js"></script>
</head>
    <div class='container'><br>
        <table class='rTable'>
            <thead>
                <tr>
                <th scope='col'>#</th>
                <th scope='col'>Nome</th>
                <th scope='col'>E-mail</th>
                <th scope='col'>Telefone</th>
                <th scope='col'>Perfil</th>
                <th scope='col'>Data Cadastro</th>
                </tr>
            </thead>";
<?php
            $contador = 0;
            foreach($users as $user){

                $contador++;

                $dataCadastro = date("d/m/Y", strtotime($user->created_at));
                
                ($user->phone != '') ? $telefone = $user->phone : $telefone = "N/A";
?>      
                <tbody>
                <tr>
                <th><?php echo $contador;?></th>
                <td><?php echo $user->name; ?></td>
                <td><?php echo $user->email; ?></td>
                <td><?php echo $telefone; ?></td>
                <td><?php echo $user->description; ?></td>
                <td><?php echo $dataCadastro; ?></td>
                </tr>
                </tbody>
<?php     
            }
?>
        </table>
    </div>

<script>
  var table2excel = new Table2Excel();
  table2excel.export(document.querySelectorAll("table"));
  setTimeout( function() {
        window.close();
    }, 10 ); 
</script>



