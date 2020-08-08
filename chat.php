
<?php
                require 'db.php';
                
                    $query = "SELECT * FROM chat_info ORDER BY id DESC";
                    $query_run   = mysqli_query($con,$query);
//                    $query_run =$con -> query($query);
                
//                    $query_array = mysql_fetch_assoc($query_run)
                    
                    while($query_row = mysqli_fetch_assoc($query_run)):?>
                
                <div id ="chat_data">
                </div>
                <span style="color:SEAGREEN;"><font size='3.5pt'><?php echo $query_row['name'].' : '; ?></font></span>
                         <?php 
                          $secret_key = 'JswnthSv';
                          $secret_iv = 'Jaswanth09Sv'; 
                          $output = false;
                          $string=$query_row['msg'];
                          $encrypt_method = "AES-256-CBC";
                          $key = hash( 'sha256', $secret_key );
                          $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
                          $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
                          ?>
                <span style="font-family:Bedrock;"><?php echo $output; ?></span>
                <span style = "font-family:Bedrock;float:right;"><?php echo formatDate($query_row['date']); ?></span>
<!--
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
-->
                
                <?php endwhile; ?>