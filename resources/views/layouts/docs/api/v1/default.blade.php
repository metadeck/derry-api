<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        @include('includes.docs.api.v1.head')
    </head>
    <body>

        <div class="container">
            <div class="row">
                <div class="col-3" id="sidebar">
                    <div class="column-content">
                        <div class="search-header">
                            <img src="/assets/docs/api.v1/img/f2m2_logo.svg" class="logo" alt="Logo" />
                            <input id="search" type="text" placeholder="Search">
                        </div>
                        <ul id="navigation">

                            <li><a href="#introduction">Introduction</a></li>

                            

                            <li>
                                <a href="#Business">Business</a>
                                <ul>
									<li><a href="#Business_index">index</a></li>
</ul>
                            </li>


                            <li>
                                <a href="#NearbyBusiness">NearbyBusiness</a>
                                <ul>
									<li><a href="#NearbyBusiness_index">index</a></li>
</ul>
                            </li>


                        </ul>
                    </div>
                </div>
                <div class="col-9" id="main-content">

                    <div class="column-content">

                        @include('includes.docs.api.v1.introduction')

                        <hr />

                                                

                                                <a href="#" class="waypoint" name="Business"></a>
                        <h2>Business</h2>
                        <p></p>

                        
                        <a href="#" class="waypoint" name="Business_index"></a>
                        <div class="endpoint-header">
                            <ul>
                            <li><h2>GET</h2></li>
                            <li><h3>index</h3></li>
                            <li>api/v1/businesses</li>
                          </ul>
                        </div>

                        <div>
                          <p class="endpoint-short-desc">Get a list of businesses.</p>
                        </div>
                       <!--  <div class="parameter-header">
                             <p class="endpoint-long-desc">GET /businesses</p>
                        </div> -->
                        <form class="api-explorer-form" uri="api/v1/businesses" type="GET">
                          <div class="endpoint-paramenters">
                            
                          </div>
                           <div class="generate-response" >
                              <!-- <input type="hidden" name="_method" value="GET"> -->
                              <input type="submit" class="generate-response-btn" value="Generate Example Response">
                          </div>
                        </form>
                        <hr>
                        

                                                <a href="#" class="waypoint" name="NearbyBusiness"></a>
                        <h2>NearbyBusiness</h2>
                        <p></p>

                        
                        <a href="#" class="waypoint" name="NearbyBusiness_index"></a>
                        <div class="endpoint-header">
                            <ul>
                            <li><h2>GET</h2></li>
                            <li><h3>index</h3></li>
                            <li>api/v1/businesses/nearby</li>
                          </ul>
                        </div>

                        <div>
                          <p class="endpoint-short-desc">Show a listing of nearby places</p>
                        </div>
                       <!--  <div class="parameter-header">
                             <p class="endpoint-long-desc"></p>
                        </div> -->
                        <form class="api-explorer-form" uri="api/v1/businesses/nearby" type="GET">
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
                                <div class="parameter-name">Request$request</div>
                                <div class="parameter-type">\Request</div>
                                <div class="parameter-desc"></div>
                                <div class="parameter-value">
                                    <input type="text" class="parameter-value-text" name="Request$request">
                                </div>
                              </li>

                            </ul>
                          </div>
                           <div class="generate-response" >
                              <!-- <input type="hidden" name="_method" value="GET"> -->
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
