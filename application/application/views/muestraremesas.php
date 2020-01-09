                        <div class="form-group"> <!-- State Button -->
                            <font color='red'>*</font><label for="id_registro_remesa" class="control-label">Remesa</label>
                                <select class="form-control form-control-lg" id="id_registro_remesa" name="id_registro_remesa">
                                    <option value="" selected="true">SELECCIONE</option>
						<?php 

						foreach ($remesasMostrar as $remesa) {
						    echo 'Entre en la función';
							echo "<option value='".$remesa['id_registro_remesa']."'>".$remesa['nombre_remesa']."</option>";
						}
						?>

                                </select>                    
                        </div>