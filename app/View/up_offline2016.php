<script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
<div class="row">
    <div class="widget">
        <div class="widget-header transparent">
            <h2 class="text-center"><strong>Upload Arquivo</strong> OffLine</h2>
            <div class="additional-btn">
                <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>                
            </div>
        </div>        
        <div class="widget-content padding">
            <div id="basic-form">
                <form method="POST" action="../Controller/upload_offline.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="label_turnos">Arquivo .xls:</label>
                        <input type="file" class="form-control" id="arquivo" name="arquivo">                        
                    </div>
                    <div class="form-group">
                        <label for="label_turnos">Nome do Arquivo:</label>
                        <input type="text" class="form-control" id="nome_arquivo" name="nome_arquivo">
                    </div>
                    <div class="form-group">
                        <label for="label_turnos">Nome do Médico:</label>
                        <input type="text" class="form-control" id="nome_medico" name="nome_medico">
                    </div>
                    <div class="form-group">
                        <label for="label_turnos">CRM:</label>
                        <input type="text" class="form-control" id="crm" name="crm">
                    </div>
                    <button class="btn btn-primary btn-dropbox pull-right" id="envia" type="submit">Upload do arquivo <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span></button>
                </form>
            </div>
        </div>
    </div>
    <div class="widget">
        <div class="widget-content padding">
            <div id="conteudo_convocar_loja"></div>
        </div>        
    </div>
</div>