<?php
$timestamp = time();
?>
<script src="../js/JQuery/jquery-1.11.1.min.js"></script><!--sempre chamar, com jquery ui o $ajax não funciona-->
<script src="../../tools/Uploadify/jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="../../tools/Uploadify/uploadify.css">
<script>
    $(document).ready(function () {
        $(function () {
            $('#fotos').uploadify({
                'formData': {
                    'timestamp': '<?php echo $timestamp; ?>',
                    'token': '<?php echo md5('unique_salt' . $timestamp); ?>',
                    'method': 'post',
                    'buttonText': 'Anexar Arquivos',
                    'fileSizeLimit': 2000
                },
                'swf': '../../tools/Uploadify/uploadify.swf',
                'uploader': '../../tools/Uploadify/uploadify_5.php'
            });
        });
    });
</script>
<div class="row">
    <div class="widget">
        <div class="widget-header transparent">
            <h2><strong>Adicionar</strong> TXT Bradesco WEBTRAN</h2>
            <div class="additional-btn">
                <a href="#" class="hidden reload"><i class="icon-ccw-1"></i></a>
                <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>
                <a href="#" class="widget-close"><i class="icon-cancel-3"></i></a>
            </div>
        </div>
        <div class="widget-content padding">
            <div id="basic-form">
                <form id="form" method="POST">
                    <div class="form-group">
                        <label for="label_foto">Arquivo:</label>                        
                        <input class="form-control" id="fotos" name="fotos" type="file" />                        
                    </div>                    
                </form>
            </div>
        </div>
    </div>    
</div>