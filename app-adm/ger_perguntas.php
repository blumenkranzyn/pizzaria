<?php require("header.php");?>
<script type="text/ecmascript">
   function excluir(id){
       
        var conf = confirm("Tem certeza que deseja excluir esse registro?");
        if(conf == true)
        {
                $.post("sql/excluir.php?acao=perguntas",{id: id}, function(pegar_dados){
                $(".retorno").fadeIn("slow").html(pegar_dados);
                });
        }
        
          
	
   }
</script>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="box">
                            <div class="box-title">
                                <h3><i class="icon-table"></i> Gerenciamento FAQ</h3>
                                <div class="box-tool">
                                    <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
                                    <a data-action="close" href="#"><i class="icon-remove"></i></a>
                                </div>
                            </div>
                            <div class="box-content">
                                <div class="btn-toolbar pull-right clearfix">
                                    <div class="btn-group">
                                        <a class="btn btn-circle show-tooltip" title="Inserir Pergunta" href="cad_pergunta.php"><i class="icon-plus"></i></a>
                                     
                                    </div>
                                
                                </div>
                                <div class="clearfix"></div>
                                <table class="table table-advance" id="table1">
                                    <thead>
                                        <tr>
                                            <th>Pergunta</th>
                                            <th>Resposta</th>
                                            <th>Status</th>
                                            <th style="width:100px">Opções</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        $sql = 'SELECT * FROM tbl_perguntas ORDER BY id DESC';         
                                        try{

                                            $read = $db->prepare($sql);
                                            $read->execute();

                                        } catch (PDOException $ex) {
                                            echo 'Erro ao Buscar Dados! - ' . $ex->getMessage();
                                        }

                                        while($rs = $read->fetch(PDO::FETCH_OBJ))
                                        {
                                                        if($rs->status == 1){
                                                                $status = "Ativo"; 
                                                                }else{
                                                                        $status = "Inativo"; 
                                                                }
                                            echo'
                                            <tr class="table-flag-blue">
                                            <td>'.$rs->pergunta.'</td>
                                            <td>'.$rs->resposta.'</td>
                                            <td>'.$status.'</td>
                                            <td>
                                                <div class=btn-group">
                                                    <a class="btn btn-small show-tooltip" title="Editar" href="alt_pergunta.php?id='.$rs->id.'"><i class="icon-edit"></i></a>
                                                    <a class="btn btn-small btn-danger show-tooltip" title="Deletar" onclick="excluir('.$rs->id.')"><i class="icon-trash"></i></a>
                                                </div>
                                            </td>
                                        </tr>';
                                        }       

                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="retorno"></div>
<?php require("footer.php"); ?>