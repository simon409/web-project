<?php
    $fid=$_GET['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/detail.css">
    <link rel="stylesheet/less" type="text/css" href="./style/fdetstyle.less" />
    <script src="https://cdn.jsdelivr.net/npm/less@4.1.1" ></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Flight to ...</title>
</head>
<body>
    <main>
        <div class="plan">
            <div class="colorhead">
                <h2>United States → Morocco</h2>
            </div>
            <div class="padded">
                <div class="heading-time">
                    <h3>
                        Departure:
                    </h3>
                </div>
                <div class="showpcode">
                    <span>USA</span>
                    <span><i class="fa-solid fa-plane"></i></span>
                    <span>MAR</span>
                </div>
                <div class="selectper">
                    <div class="adult">
                        <a onclick="incrpers(1);"><i class="fa-solid fa-circle-minus"></i></a>
                        <input type="text" id="person" value="1 Adults" readonly>
                        <a onclick="incrpers(0);"><i class="fa-solid fa-circle-plus"></i></a>
                    </div>
                    <div class="child">
                        <a onclick="incrchild(1);"><i class="fa-solid fa-circle-minus"></i></a>
                        <input type="text" id="child" value="0 Children" readonly>
                        <a onclick="incrchild(0);"><i class="fa-solid fa-circle-plus"></i></a>
                    </div>
                </div>
                <div class="fplan">
                    <fieldset>
                        <legend>
                            <h2>Flight plan:</h2>
                        </legend>
                        <div class="dptarr">
                        <div class="sectionWrap">
                            <div class="sectionSegment sectionSegment-head">
                                <div class="sectionNum">
                                </div>
                                <div class="sectionLeft">Departure</div>
                                <div class="sectionLine"></div>
                                <div class="sectionRight"><span>Total travel time 8 hours 30 minutes</span><span class="sectionCrossDayLabel">Overnight Arrival</span></div>
                            </div>
                            <div class="sectionSegment">
                                <div class="sectionNum"></div>
                                <div class="sectionLeft">10:20<span class="sectionCrossday">+1</span></div>
                                <div class="sectionLine"><span class="sectionDot"></span></div>
                                <div class="sectionRight">
                                <div>John F.Kennedy International Airport JFK</div>
                                <div class="sectionRight-desc">Vanilla Air JW107 Economy Class N<span class="sectionRight-descOpt">*JL121</span></div>
                                <div class="sectionRight-desc">2 hours and 55 minutes</div>
                                </div>
                            </div>
                            <div class="sectionSegment sectionSegment-transit">
                                <div class="sectionNum"></div>
                                <div class="sectionLeft"></div>
                                <div class="sectionLine"><span class="sectionDot"></span></div>
                                <div class="sectionRight">
                                <div>Test International Airport TST</div>
                                <div class="sectionRight-desc">Vanilla Air JW107 Economy Class N<span class="sectionRight-descOpt">*JL121</span></div>
                                <div class="sectionRight-desc">2 hours and 55 minutes</div>
                                </div>
                            </div>
                            <div class="sectionSegment">
                                <div class="sectionNum"></div>
                                <div class="sectionLeft">18:50<span class="sectionCrossday">+1</span></div>
                                <div class="sectionLine"><span class="sectionDot"></span></div>
                                <div class="sectionRight">
                                <div>mohammed v international airport CMN</div>
                                <div class="sectionRight-desc">2 hours and 55 minutes</div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="features">
                    <h2>Features: </h2>
                    <div class="container">
                        <div class="card">
                            <div class="empty"></div>
                            <i class="fa-solid fa-fan"></i>
                            <span>Air Conditioner</span>
                        </div>
                        <div class="card">
                            <div class="empty"></div>
                            <i class="fa-solid fa-utensils"></i>
                            <span>Restaurant</span>
                        </div>
                        <div class="card">
                            <div class="empty"></div>
                            <i class="fa-solid fa-taxi"></i>
                            <span>Taxi</span>
                        </div>
                        <div class="card">
                            <div class="empty"></div>
                            <i class="fa-solid fa-square-parking"></i>
                            <span>Parking</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="prices">
            <form action="">
                <div class="header">
                    <h2>Details</h2>
                    <div class="line">
                        <hr>
                    </div>
                </div>
                <div class="passenger">
                    <div class="adlt">
                        <input type="text" id="adlt" value="1" readonly> <span> Adult x 500$</span>
                    </div>
                    <div class="cld">
                        <input type="text" id="chld" value="0" readonly> <span> Children x 350$</span>
                    </div>
                </div>
                <div class="price">
                    Total: 
                    <input type="text" name="price" value="500$" readonly>
                </div>
                <div class="btn">
                    <input type="submit" value="Proceed to check out">
                </div>
            </form>
        </div>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./script/app.js"></script>
    <script src="./script/animation.js"></script>
    <script src="https://kit.fontawesome.com/34ab47bcfb.js" crossorigin="anonymous"></script>
</body>
</html>