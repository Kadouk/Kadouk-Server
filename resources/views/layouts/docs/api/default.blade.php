<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        @include('includes.docs.api.head')
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col-3" id="sidebar">
                    <div class="column-content">
                        <div class="search-header">
                            <img src="/assets/docs/api/img/f2m2_logo.svg" class="logo" alt="Logo" />
                            <input id="search" type="text" placeholder="Search">
                        </div>
                        <ul id="navigation">

                            <li><a href="#introduction">Introduction</a></li>

                            

                            <li>
                                <a href="#Closure">Closure</a>
                                <ul></ul>
                            </li>


                            <li>
                                <a href="#User">User</a>
                                <ul>
									<li><a href="#User_login">login</a></li>

									<li><a href="#User_register">register</a></li>

									<li><a href="#User_details">details</a></li>
</ul>
                            </li>


                        </ul>
                    </div>
                </div>
                <div class="col-9" id="main-content">

                    <div class="column-content">

                        @include('includes.docs.api.introduction')

                        <hr />

                                                

                                                <a href="#" class="waypoint" name="Closure"></a>
                        <h2>Closure</h2>
                        <p></p>

                                                

                                                <a href="#" class="waypoint" name="User"></a>
                        <h2>User</h2>
                        <p></p>

                        
                        <a href="#" class="waypoint" name="User_login"></a>
                        <div class="endpoint-header">
                            <ul>
                            <li><h2>POST</h2></li>
                            <li><h3>login</h3></li>
                            <li>api/login</li>
                          </ul>
                        </div>

                        <div>
                          <p class="endpoint-short-desc">login api</p>
                        </div>
                       <!--  <div class="parameter-header">
                             <p class="endpoint-long-desc"></p>
                        </div> -->
                        <form class="api-explorer-form" uri="api/login" type="POST">
                          <div class="endpoint-paramenters">
                            
                          </div>
                           <div class="generate-response" >
                              <!-- <input type="hidden" name="_method" value="POST"> -->
                              <input type="submit" class="generate-response-btn" value="Generate Example Response">
                          </div>
                        </form>
                        <hr>

                        <a href="#" class="waypoint" name="User_register"></a>
                        <div class="endpoint-header">
                            <ul>
                            <li><h2>POST</h2></li>
                            <li><h3>register</h3></li>
                            <li>api/register</li>
                          </ul>
                        </div>

                        <div>
                          <p class="endpoint-short-desc">Register api
POST /register/</p>
                        </div>
                       <!--  <div class="parameter-header">
                             <p class="endpoint-long-desc"></p>
                        </div> -->
                        <form class="api-explorer-form" uri="api/register" type="POST">
                          <div class="endpoint-paramenters">
                            <h4>Parameters</h4>
                            <ul>
                              <li class="parameter-header">
                                <div class="parameter-name">PARAMETER</div>
                                <div class="parameter-type">TYPE</div>
                                <div class="parameter-desc">DESCRIPTION</div>
                                <div class="parameter-value">VALUE</div>
                              </li>
                                                           <li>
                                <div class="parameter-name">name</div>
                                <div class="parameter-type">string</div>
                                <div class="parameter-desc">The name of a User</div>
                                <div class="parameter-value">
                                    <input type="text" class="parameter-value-text" name="name">
                                </div>
                              </li>
                             <li>
                                <div class="parameter-name">phone</div>
                                <div class="parameter-type">string</div>
                                <div class="parameter-desc">The phone of a User</div>
                                <div class="parameter-value">
                                    <input type="text" class="parameter-value-text" name="phone">
                                </div>
                              </li>
                             <li>
                                <div class="parameter-name">gender</div>
                                <div class="parameter-type">string</div>
                                <div class="parameter-desc">The gender of a User</div>
                                <div class="parameter-value">
                                    <input type="text" class="parameter-value-text" name="gender">
                                </div>
                              </li>
                             <li>
                                <div class="parameter-name">birth</div>
                                <div class="parameter-type">string</div>
                                <div class="parameter-desc">The birth of a User</div>
                                <div class="parameter-value">
                                    <input type="text" class="parameter-value-text" name="birth">
                                </div>
                              </li>

                            </ul>
                          </div>
                           <div class="generate-response" >
                              <!-- <input type="hidden" name="_method" value="POST"> -->
                              <input type="submit" class="generate-response-btn" value="Generate Example Response">
                          </div>
                        </form>
                        <hr>

                        <a href="#" class="waypoint" name="User_details"></a>
                        <div class="endpoint-header">
                            <ul>
                            <li><h2>POST</h2></li>
                            <li><h3>details</h3></li>
                            <li>api/details</li>
                          </ul>
                        </div>

                        <div>
                          <p class="endpoint-short-desc">details api</p>
                        </div>
                       <!--  <div class="parameter-header">
                             <p class="endpoint-long-desc"></p>
                        </div> -->
                        <form class="api-explorer-form" uri="api/details" type="POST">
                          <div class="endpoint-paramenters">
                            
                          </div>
                           <div class="generate-response" >
                              <!-- <input type="hidden" name="_method" value="POST"> -->
                              <input type="submit" class="generate-response-btn" value="Generate Example Response">
                          </div>
                        </form>
                        <hr>


                    </div>
                </div>
            </div>
        </div>


    </body>
</html>
