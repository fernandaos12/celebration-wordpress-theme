<?php

add_action('do_meta_boxes', 'createMetabox_sample');
add_action('save_post','saveMetabox_sample');


function createMetabox_sample(){
	
	add_meta_box('tipo', 'title', 'metabox_sample', 'exemplo' , 'normal', 'high');
	
}

function metabox_sample($idPost){ 

	global $post;
	global $idPost; 
	$idPost = $post -> ID;
		
?>



 
        <div id="mtb-content">
        
        
        <!-- Alertas --
     	<div class="error">Mensagem de erro</div>
        <div class="updated">Mensagem de alerta</div> -->
        
        <h2>Modelo de metaboxes </h2>
        
        <div class="metabox-holder">
            
            <div class="postbox">
            	
                <h3>Título do Box</h3>
            	
                <div class="inside">
            		
                    texto
            	
                </div>
            
            </div>
        
        </div>
        
        
        
        <h2>Modelo de formulário </h2>        
        
          <form method="post" action="">
          
          <table class="form-table">
              
              <tr>
                <td colspan="2"><div class="form-title">Titulo da sessão</div></td>
              </tr>
              <tr>
                <th>.small-text</th>
                <td><input id="txt1" type="text" value="" class="small-text" /></td>
              </tr>
              <tr>
                <th>sem formatação</th>
                <td><input id="txt1" type="text" value="" /></td>
              </tr>
              <tr>
                <th>.code</th>
                <td><input id="txt1" type="text" value="" class="code" /></td>
              </tr>
              <tr>
                <th>.all-options</th>
                <td><input id="txt1" type="text" value="" class="all-options" /></td>
              </tr>
              <tr>
                <th>.regular-text</th>
                <td><input id="txt1" type="text" value="" class="regular-text" /></td>
              </tr>
              <tr>
                <th>.large-text</th>
                <td><input id="txt1" type="text" value="" class="large-text" /></td>
              </tr>
              <tr><td colspan="2"><div class="form-title">Titulo da sessão</div></td></tr>
              <tr>
                <th>sem formatação</th>
                <td><textarea></textarea></td>
              </tr>
              <tr>
                <th>.all-options</th>
                <td><textarea class="all-options"></textarea></td>
              </tr>
              <tr>
                <th>.large-text</th>
                <td><textarea class="large-text"></textarea></td>
              </tr>
              <tr><td colspan="2"><div class="form-title">Titulo da sessão</div></td></tr>
              <tr>
                <th>checkbox</th>
                <td>
                  <fieldset>
                    <legend>Legenda visível</legend>
                    <label>
                    <input name="" type="checkbox" />
                    Optar por escolher ou não uma única opção
                    </label>
                  </fieldset>
                </td>
              </tr>
              <tr>
                <th scope="row">radio</th>
                <td>
                  <fieldset>
                    <legend class="screen-reader-text">Legenda oculta</legend>
                    <label title="Opção 1"><input type="radio" /> <span>Descrição da opção #1</span></label><br />
                    <label title="Opção 2"><input type="radio" /> <span>Descrição da opção #2</span></label>
                  </fieldset>
                </td>
              </tr>
              <tr><td colspan="2"><div class="form-title">Titulo da sessão</div></td></tr>
              <tr>
                <th>lista de seleção</th>
                <td>
                  <select name="">
                    <option value=""></option>
                    <option selected="true" value="">Opção #1</option>
                    <option value="">Opção #2</option>
                  </select>
                </td>
              </tr>
        </table>
        </form>
        
  		<br><br>
        
        <h2>Modelo de botões </h2>
        	
        <button class="button">button 1 </button><br>
        <button class="button-primary">button primary </button><br>
        <button class="button-secondary">button secondary</button><br>
        <button class="button-highlighted">button hightlighted</button>
            
        <br><br>
                
        
        <h2>Modelo de tabelas</h2>
        
        <table class="widefat">
            
            <thead>
                
                <tr>
                <th>Título 1</th>
                <th>Título 2</th>
                </tr>
            
            </thead>
            
            <tfoot>
                
                <tr>
                <th>Título 1</th>
                <th>Título 2</th>
                </tr>
            
            </tfoot>
            
            <tbody>

                <tr>
                <td>Célula 1-1</td>
                <td>Célula 1-2</td>
                </tr>
                
                <tr class="alternate">
                <td>Célula 2-1</td>
                <td>Célula 2-2</td>
                </tr>

            </tbody>
        
        </table>
        
        <br><br>
        
        <table class="widefat">
        	
            <tr><th>Célula título</th></tr>
        	<tr><td>Linha normal</td></tr>
        	<tr class="alternate"><td>Linha com fundo alternativo</td></tr>
        	<tr><td class="row-title">Linha em negrito</td></tr>
        
        </table>
                
        
        </div>
    



<?php }

function saveMetabox_sample($idPost) {
	
	$cep  = $_POST["txtCep"];
	if($cep == NULL){add_post_meta($idPost, 'evento_cep', $cep ,TRUE);}else{update_post_meta($idPost, 'evento_cep', $cep);}	
	

}//salvar


?>