<?php require("header.php");

if(isset($_POST['bt_save_df']))
{
    $titulo = $_POST['titulo'];
    $id_galeria = $_POST['id_galeria'];
        
    $uploaddir = '../midias/imagens/';
    $pastadestino = 'midias/imagens/';
    $dividir2 = end(explode(".", $_FILES['imagem1']['name']));
    $nome = time();
    $nome_imagem2 = $nome . '1.' . $dividir2;
    $uploadfile = $uploaddir . $nome . '1.' . $dividir2;
    if (move_uploaded_file($_FILES['imagem1']['tmp_name'], $uploaddir . $nome_imagem2)) {}   
    $img1 = $pastadestino.$nome_imagem2;
    
        
    $sql = 'INSERT INTO tbl_img_galerias (nome, imagem, galeria)';
    $sql .= ' VALUES (:titulo, :imagem, :galeria)';
            
    try{

        $create = $db->prepare($sql);
        $create->bindValue(':titulo', $titulo, PDO::PARAM_STR);
        $create->bindValue(':imagem', $img1, PDO::PARAM_STR);
        $create->bindValue(':galeria', $id_galeria, PDO::PARAM_STR);      
        if($create->execute() ){
            echo '<script type="text/javascript" >
                    location.href="imagens_galeria.php?id='.$id_galeria.'";
            </script>';

        }


    } catch (PDOException $e) {
            echo "Erro ao Cadastrar Registro! - " . $e->getMessage();
    }
}

?>
                <div class="row-fluid">
                    <div class="span12">
                        <div class="box">
                            <div class="box-title">
                                <h3><i class="icon-reorder"></i> Cadastro de Imagem</h3>
                                <div class="box-tool">
                                    <a data-action="collapse" href="#"><i class="icon-chevron-up"></i></a>
                                    <a data-action="close" href="#"><i class="icon-remove"></i></a>
                                </div>
                            </div>
                            <div class="box-content">
                                <form action="cad_img_galeria.php" class="form-horizontal" id="validation-form" method="post" enctype="multipart/form-data">   
                                    <div class="control-group">
                                        <label class="control-label" for="titulo">Nome:</label>
                                        <div class="controls">
                                            <div class="span12">
                                                <input type="text" name="titulo" id="titulo" class="input-xlarge" />
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id_galeria" id="id_galeria" value="<?php echo $_GET['id']; ?>" />
                                    <div class="control-group">
                                      <label class="control-label">Capa:</label>
                                      <div class="controls">
                                         <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="img/imagem.png" alt="" />
                                            </div>
                                            <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                            <div>
                                               <span class="btn btn-file"><span class="fileupload-new">Selecione a imagem</span>
                                               <span class="fileupload-exists">Alterar</span>
                                               <input type="file" class="default" name="imagem1" id="imagem1" data-rule-required="true"   /></span>
                                               <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remover</a>
                                            </div>
                                         </div>
                                         
                                      </div>
                                   </div>                                                                    
                                    <div class="form-actions">
                                        <input type="submit" class="btn btn-primary" name="bt_save_df" value="Salvar">
                                        <a href="ger_galerias.php"><button type="button" class="btn">Cancelar</button></a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>  
<?php require("footer.php");?>