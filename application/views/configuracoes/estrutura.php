<!-- MAIN PANEL -->
<div id="main" role="main">

    <!-- RIBBON -->
    <div id="ribbon">

        <span class="ribbon-button-alignment">
            <span id="refresh" class="btn btn-ribbon" data-action="resetWidgets" data-title="refresh"  rel="tooltip" data-placement="bottom" data-original-title="<i class='text-warning fa fa-warning'></i> Atenção! Isto vai fazer reset nas suas configurações." data-html="true">
                <i class="fa fa-refresh"></i>
            </span>
        </span>

        <!-- breadcrumb -->
        <ol class="breadcrumb">
           <?php
            foreach ($breadcrumb as $bread) {
                echo "<li>" . $bread . "</li>";
            }
            ?>

        </ol>
        <!-- end breadcrumb -->

    </div>
    <!-- END RIBBON -->

    <!-- MAIN CONTENT -->
    <div id="content">
        <div class="row">
        </div>
        <!-- widget grid -->
        <section id="widget-grid" class="">
            <div class="row">
                <article class="col-sm-12 col-md-12 col-lg-12">

                    <!-- Widget ID (each widget will need unique ID)-->
                    <div class="jarviswidget jarviswidget-color-red" id="wid-id-permissoes" data-widget-editbutton="false">
                        <!-- widget options:
usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

data-widget-colorbutton="false"
data-widget-editbutton="false"
data-widget-togglebutton="false"
data-widget-deletebutton="false"
data-widget-fullscreenbutton="false"
data-widget-custombutton="false"
data-widget-collapsed="true"
data-widget-sortable="false"

-->
                        <header>
                            <span class="widget-icon"> <i class="fa fa-sitemap"></i> </span>
                            <h2>Estrutura de Permissões</h2>

                        </header>

                        <!-- widget div-->
                        <div>

                            <!-- widget edit box -->
                            <div class="jarviswidget-editbox">
                                <!-- This area used as dropdown edit box -->

                            </div>
                            <!-- end widget edit box -->

                            <!-- widget content -->
                            <div class="widget-body">
                                <div class="tree smart-form">
                                    <ul>
                                        <li>
                                            <span><i class="fa fa-lg fa-folder-open"></i> <?php echo $this->config->item('title'); ?></span>
                                            <ul>
                                               <?php
                                                
                                                function tree($struct){
                                                    foreach ($struct as $st){
                                                        if(is_array($st)){
                                                            if($st['sub']){
                                                                echo "<li>";
                                                                echo '<span><i class="fa fa-lg fa-minus-circle"></i> ' . $st['name'] . '</span>'; 
                                                                echo "<ul>";
                                                                tree($st);
                                                                echo "</ul>";
                                                                echo '</li>';   
                                                            }else{
                                                                echo "<li>";
                                                                echo '<span><i class="icon-leaf"></i> ' . $st['name'] . '</span>';
                                                                echo '</li>';    
                                                            }
                                                        }
                                                    }
                                                }                                                
                                                tree($struct);
                                                ?>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>

                            </div>
                            <!-- end widget content -->

                        </div>
                        <!-- end widget div -->

                    </div>
                    <!-- end widget -->

                </article>
            </div>
            <!--                  
foreach ($users as &$user){
foreach ($user as $key => $value) {
echo "Key: $key; Value: $value<br />\n";
}
}
-->
        </section>
        <!-- end widget grid -->
    </div>
    <!-- END MAIN CONTENT -->

</div>
<!-- END MAIN PANEL -->