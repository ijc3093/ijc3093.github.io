<?php 
    $active = "quiz";
    include('header.php');
?>

<div id="content" class="container">
    <!-- Wrapper -->    
    <!-- begin Roshan's code  -->
    <!-- Content of the page -->   
    <?php 
        function checkAnswers($answers){
            $score = 0;
            $responses = [];
            if($answers == []){
                $responses["q1"]  = "color:red;";
                $responses["q2"]  = "color:red;";
                $responses["q3"]  = "color:red;";
                $responses["q4"]  = "color:red;";
                $responses["q5"]  = "color:red;";
                $responses["q6"]  = "color:red;";
                $responses["q7"]  = "color:red;";
                $responses["q8"]  = "color:red;";
                $responses["q9"]  = "color:red;";
                $responses["q10"] = "color:red;";
            }
            else{
                for($i = 1; $i <= 10; $i++){
                    if(isset($answers["q".$i."-choices"])){
                        switch($answers["q".$i."-choices"]){
                            case("A"):
                                if($i == 6){
                                    $responses["q".$i]="color:green"; 
                                    $score++;
                                }else{
                                    $responses["q".$i] = "color:red;";
                                }
                                break;
                            case("B"):
                                if($i == 2 || $i == 5 || $i == 7){
                                    $responses["q".$i]="color:green"; 
                                    $score++;
                                }else{
                                    $responses["q".$i] = "color:red;";
                                }
                                break;
                            case("C"):
                                if($i == 4 || $i ==8 || $i ==10){
                                    $responses["q".$i]="color:green"; 
                                    $score++;
                                }else{
                                    $responses["q".$i] = "color:red;";
                                }
                                break;
                            case("D"):
                                if($i ==1 || $i == 3 || $i == 9){
                                    $responses["q".$i]="color:green"; 
                                    $score++;
                                }else{
                                    $responses["q".$i] = "color:red;";
                                }
                                break;
                            case("E"):
                                $responses["q".$i] = "color:red;";
                            default:
                                $responses["q".$i] = "color:red;";
                                break;
                        } 
                    }else{
                        $responses["q".$i] = "color:red;";
                    }
                }
                
            }
            $responses['score'] = $score;
            return $responses;
        }               
        if(isset($_GET['action']) == 'submit'){
            $responses = checkAnswers($_POST);
        }   
    ?>
    <h3>UNIX Quiz</h3>  
    <?php
        if(isset($responses)){
            echo '<p>You got '.$responses['score'].'/10 correct!</p>';
        }
    ?>
    
    <form action="?action=submit" method="post" id="quiz">
        <ol>
            <!-- Question 1 -->
            <li>
                
                <h3 style="<?php if(isset($responses["q1"])){ echo $responses["q1"];}?>">Which Unix command is used to remove a directory&#63;</h3>
                <div>
                    <input type="radio" name="q1-choices" value="A" />
                    <label for="q1-choices-A">A) rdir</label>
                </div>
                <div>
                    <input type="radio" name="q1-choices" value="B" />
                    <label for="q1-choices-B">B) remove</label>
                </div>
                <div>
                    <input type="radio" name="q1-choices" value="C" />
                    <label for="q1-choices-C">C) rd</label>
                </div>
                <div>
                    <input type="radio" name="q1-choices" value="D" />
                    <label for="q1-choices-D">D) rmdir</label>
                </div>
                <div>
                    <input type="radio" name="q1-choices" value="E" />
                    <label for="q1-choices-E">E) None of the above</label>
                </div>
            </li>
            <!-- Question 2 -->
            <li>
                <h3 style="<?php if(isset($responses["q2"])){ echo $responses["q2"];}?>">Which Unix command is used to remove files&#63;</h3>
                <div>
                    <input type="radio" name="q2-choices" value="A" />
                    <label for="q2-choices-A">A) dm</label>
                </div>
                <div>
                    <input type="radio" name="q2-choices" value="B" />
                    <label for="q2-choices-B">B) rm</label>
                </div>
                <div>
                    <input type="radio" name="q2-choices" value="C" />
                    <label for="q2-choices-C">C) delete</label>
                </div>
                <div>
                    <input type="radio" name="q2-choices" value="D" />
                    <label for="q2-choices-D">D) erase</label>
                </div>
                <div>
                    <input type="radio" name="q2-choices" value="E" />
                    <label for="q2-choices-E">E) None of the above</label>
                </div>
            </li>
            <!-- Question 3 -->
            <li>
                <h3 style="<?php if(isset($responses["q3"])){ echo $responses["q3"];}?>">Which Unix command is used to list the contents of a directory&#63;</h3>
                <div>
                    <input type="radio" name="q3-choices" value="A" />
                    <label for="q3-choices-A">A) tar</label>
                </div>
                <div>
                    <input type="radio" name="q3-choices" value="B" />
                    <label for="q3-choices-B">B) dir</label>
                </div>
                <div>
                    <input type="radio" name="q3-choices" value="C" />
                    <label for="q3-choices-C">C) lp</label>
                </div>
                <div>
                    <input type="radio" name="q3-choices" value="D" />
                    <label for="q3-choices-D">D) ls</label>
                </div>
                <div>
                    <input type="radio" name="q3-choices" value="E" />
                    <label for="q3-choices-E">E) None of the above</label>
                </div>
            </li>
            <!-- Question 4 -->
            <li>
                <h3 style="<?php if(isset($responses["q4"])){ echo $responses["q4"];}?>">Which Unix command is used to remove jobs from a print queue&#63;</h3>
                <div>
                    <input type="radio" name="q4-choices" value="A" />
                    <label for="q4-choices-A">A) lpq</label>
                </div>
                <div>
                    <input type="radio" name="q4-choices" value="B" />
                    <label for="q4-choices-B">B) lpr</label>
                </div>
                <div>
                    <input type="radio" name="q4-choices" value="C" />
                    <label for="q4-choices-C">C)lprm</label>
                </div>
                <div>
                    <input type="radio" name="q4-choices" value="D" />
                    <label for="q4-choices-D">D) lpc</label>
                </div>
                <div>
                    <input type="radio" name="q4-choices" value="E" />
                    <label for="q4-choices-E">E) None of the above</label>
                </div>
            </li>
            <!-- Question 5 -->
            <li>
                <h3 style="<?php if(isset($responses["q5"])){ echo $responses["q5"];}?>">Which Unix command is used to add jobs to the print queue&#63;</h3>
                <div>
                    <input type="radio" name="q5-choices" value="A" />
                    <label for="q5-choices-A">A) lpd</label>
                </div>
                <div>
                    <input type="radio" name="q5-choices" value="B" />
                    <label for="q5-choices-B">B) lpr</label>
                </div>
                <div>
                    <input type="radio" name="q5-choices" value="C" />
                    <label for="q5-choices-C">C) lpq</label>
                </div>
                <div>
                    <input type="radio" name="q5-choices" value="D" />
                    <label for="q5-choices-D">D) lpc</label>
                </div>
                <div>
                    <input type="radio" name="q5-choices" value="E" />
                    <label for="q5-choices-E">E) None of the above</label>
                </div>
            </li>
            <!-- Question 6 -->
            <li>
                <h3 style="<?php if(isset($responses["q6"])){ echo $responses["q6"];}?>">Which of the following is not a communication command&#63;</h3>
                <div>
                    <input type="radio" name="q6-choices" value="A" />
                    <label for="q6-choices-A">A) grep</label>
                </div>
                <div>
                    <input type="radio" name="q6-choices" value="B" />
                    <label for="q6-choices-B">B) mail</label>
                </div>
                <div>
                    <input type="radio" name="q6-choices" value="C" />
                    <label for="q6-choices-C">C) mesg</label>
                </div>
                <div>
                    <input type="radio" name="q6-choices" value="D" />
                    <label for="q6-choices-D">D) write</label>
                </div>
                <div>
                    <input type="radio" name="q6-choices" value="E" />
                    <label for="q6-choices-E">E) None of the above</label>
                </div>
            </li>
            <!-- Question 7 -->
            <li>
                <h3 style="<?php if(isset($responses["q7"])){ echo $responses["q7"];}?>">Which of the following has the address http&#58;&#47;&#47;127&#46;0&#46;0&#46;1 &#63;</h3>   
                <div>
                    <input type="radio" name="q7-choices" value="A" />
                    <label for="q7-choices-A">A) The ISP</label>
                </div>   
                <div>
                    <input type="radio" name="q7-choices" value="B" />
                    <label for="q7-choices-B">B) PC</label>
                </div>
                <div>
                    <input type="radio" name="q7-choices" value="C" />
                    <label for="q7-choices-C">C) Windows</label>
                </div> 
                <div>
                    <input type="radio" name="q7-choices" value="D" />
                    <label for="q7-choices-D">D) Linux</label>
                </div>
                <div>
                    <input type="radio" name="q7-choices" value="E" />
                    <label for="q7-choices-E">E) None of the above</label>
                </div>
            </li>
            <!-- Question 8 -->
            <li>
                <h3 style="<?php if(isset($responses["q8"])){ echo $responses["q8"];}?>">Which Unix command is used to count the total number of lines&#44; words&#44; and characters in a file&#63;</h3>
                <div>
                    <input type="radio" name="q8-choices" value="A" />
                    <label for="q8-choices-A">A) countw</label>
                </div>
                <div>
                    <input type="radio" name="q8-choices" value="B" />
                    <label for="q8-choices-B">B) wcount</label>
                </div>
                <div>
                    <input type="radio" name="q8-choices" value="C" />
                    <label for="q8-choices-C">C) wc</label>
                </div>
                <div>
                    <input type="radio" name="q8-choices" value="D" />
                    <label for="q8-choices-D">D) count p</label>
                </div>
                <div>
                    <input type="radio" name="q8-choices" value="E" />
                    <label for="q8-choices-E">E) None of the above</label>
                </div>
            </li>
            <!-- Question 9 -->
            <li>
                <h3 style="<?php if(isset($responses["q9"])){ echo $responses["q9"];}?>">What is &#35;&#33;&#47;bin&#47;bash commonly known as&#63;</h3>  
                <div>
                    <input type="radio" name="q9-choices" value="A" />
                    <label for="q9-choices-A">A) shebang</label>
                </div>
                <div>
                    <input type="radio" name="q9-choices" value="B" />
                    <label for="q9-choices-B">B) hashbang</label>
                </div>
                <div>
                    <input type="radio" name="q9-choices" value="C" />
                    <label for="q9-choices-C">C) Script Initializer</label>
                </div> 
                <div>
                    <input type="radio" name="q9-choices" value="D" />
                    <label for="q9-choices-D">D) Both A and B</label>
                </div>
                <div>
                    <input type="radio" name="q9-choices" value="E" />
                    <label for="q9-choices-E">E) None of the above</label>
                </div>
            </li>
            <!-- Question 10 -->
            <li>
                <h3 style="<?php if(isset($responses["q10"])){ echo $responses["q10"];}?>">What makes it possible to run Windows and Linux Kernel simultaneously in parallel on the same machine&#63;</h3>
                <div>
                    <input type="radio" name="q10-choices" value="A" />
                    <label for="q10-choices-A">A) lVirtualbox</label>
                </div>
                <div>
                    <input type="radio" name="q10-choices" value="B" />
                    <label for="q10-choices-B">B) VMWare</label>
                </div>
                <div>
                    <input type="radio" name="q10-choices" value="C" />
                    <label for="q10-choices-C">C) Cooperative Linux</label>
                </div>
                <div>
                    <input type="radio" name="q10-choices" value="D" />
                    <label for="q10-choices-D">D) LAN</label>
                </div>
                <div>
                    <input type="radio" name="q10-choices" value="E" />
                    <label for="q10-choices-E">E) None of the above</label>
                </div>
            </li>
        </ol>
        <div class="text-center">
            <input class="btn btn-dark" id="submit-btn" type="submit" value="Submit Quiz" />
        </div>
    </form>
</div>
<?php include('footer.php');?>
