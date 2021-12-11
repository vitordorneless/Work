<script src="../js/JQuery/jquery-1.11.1.min.js"></script>
<style type="text/css">
    #imgpos {
        position:absolute;
        left:667px;
    }
</style>
<div class="widget">
    <div class="widget-header transparent">
        <h2><strong>Listar Associados</strong><acronym title="Informe os campos para otimizar o resultado!!!"> Herval</acronym></h2>
        <div class="additional-btn">            
            <a href="#" class="widget-toggle"><i class="icon-down-open-2"></i></a>            
        </div>
    </div>
    <div class="widget-content padding">
        <div class="form-group">
            <form method="POST" action="../Controller/herval_extras_planilha.php">
                <div class="form-group">
                    <label for="agencia_label">Loja / Bandeira:</label>
                    <select class="form-control" id="search" name="search" required>
                        <option selected value="na">
                            Selecione...
                        </option>
                        <?php
                        include '../config/database_mysql.php';
                        $pdo = Database::connect();
                        $sql = "select id, unidade from herval_unidades where status = 1 order by unidade asc";
                        foreach ($pdo->query($sql) as $value) {
                            echo '<option value=' . $value['id'] . '>' . $value['unidade'] . '</option>';
                        }
                        Database::disconnect();
                        ?>
                    </select>
                    <div class="form-inline" id="search_error"></div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-facebook" id="envia" type="submit">Gerar Excel Bonito!</button>
                </div>
            </form>
        </div>
    </div>
    <div class="widget-content padding" id="conteudo_periodico"></div>
</div>