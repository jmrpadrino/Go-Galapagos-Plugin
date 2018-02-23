<div class="container-fluid no-padding booking-filters-view">
    <div class="booking-filters-header">
        <div class="row">
            <div class="col-xs-12">
                <h1>Find your cruise in Galapagos!</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <p>Please choose beetwen the items below</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="col-xs-7 text-center" role="presentation" class="active"><a href="#legend" aria-controls="legend" role="tab" data-toggle="tab">Galapagos Legend</a></li>
                <li class="col-xs-5 text-center" role="presentation"><a href="#corals" aria-controls="corals" role="tab" data-toggle="tab">Coral Yachts</a></li>
            </ul>
        </div>
        <div class="col-xs-12">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="legend">
                    <img src="http://placehold.it/480x150?text=ImageLegend" class="img-responsive">
                    <button id="select-month-btn" class="btn btn-default btn-lg btn-choose-month"><span class="fa fa-calendar"></span> Select your departure date</button>
                </div>
                <div role="tabpanel" class="tab-pane" id="corals">
                    <img src="http://placehold.it/480x150?text=ImageCorals" class="img-responsive">
                    <button id="select-month-btn" class="btn btn-default btn-lg btn-choose-month"><span class="fa fa-calendar"></span> Select your departure date</button>
                </div>            
            </div>
        </div>
    </div>
</div>
<div id="month-picker" class="month-picker">
    <div id="btn-go-back" class="btn-go-back">
        <span class="fa fa-long-arrow-left"></span>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h2><span class="fa fa-calendar"></span> Select departure date</h2>
            </div>
        </div>
        <div class="row">
            <div class="months-placeholder">
                <div class="col-xs-4 no-padding text-center month-placeholder"><div class="inner-month disable"><span>1</span></div></div>
                <div class="col-xs-4 no-padding text-center month-placeholder"><div class="inner-month disable"><span>2</span></div></div>
                <div class="col-xs-4 no-padding text-center month-placeholder"><div class="inner-month disable"><span>3</span></div></div>
                <div class="col-xs-4 no-padding text-center month-placeholder"><div class="inner-month disable"><span>4</span></div></div>
                <div class="col-xs-4 no-padding text-center month-placeholder"><div class="inner-month"><span>5</span></div></div>
                <div class="col-xs-4 no-padding text-center month-placeholder"><div class="inner-month"><span>6</span></div></div>
                <div class="col-xs-4 no-padding text-center month-placeholder"><div class="inner-month"><span>7</span></div></div>
                <div class="col-xs-4 no-padding text-center month-placeholder"><div class="inner-month selected"><span>8</span></div></div>
                <div class="col-xs-4 no-padding text-center month-placeholder"><div class="inner-month"><span>9</span></div></div>
                <div class="col-xs-4 no-padding text-center month-placeholder"><div class="inner-month"><span>10</span></div></div>
                <div class="col-xs-4 no-padding text-center month-placeholder"><div class="inner-month"><span>11</span></div></div>
                <div class="col-xs-4 no-padding text-center month-placeholder"><div class="inner-month"><span>12</span></div></div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12 text-right">
                <button id="btn-ok-date" class="btn btn-success">OK</button>
            </div>
        </div>
    </div>
</div>
<div id="order-details-box" class="order-details-box">
    <div id="btn-go-back-sumary" class="btn-go-back">
        <span class="fa fa-long-arrow-left"></span>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 text-center">
                <h2>Sumary</h2>
                
            </div>
        </div>
    </div>
</div>
<div id="show-calendar" class="btn-alter btn-right-upper">
    <span class="fa fa-calendar"></span>
</div>
<div class="btn-alter btn-order-details_2">
    <span class="fa fa-ellipsis-v"></span>
</div>