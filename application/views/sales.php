<form>
    <body class="SalesBody">
        <h2>Item List</h2>
        <p>Input the amount of items</p> 
        <hr>
        {sales}        
        {supplies}
        <div class="listgroup" id="buttongroup">
            <ul>
                <div class="col-xs-4 title">
                    <a href="{link}" class="name">{supply}</a>
                    <input id="focusedInput" class="form-control" type="number" min="0" placeholder="Enter Value" autocomplete="off">
                </div>
                <div class="list-group">
                    <a type="text" class="list-group-item" value="${price}" onfocus="this.blur()">${price}</a>
                    <a type="text" class="list-group-item" value="{description}" onfocus="this.blur()">{description}</a>
                </div>
                <br/><br/><br/><br/>
            </ul>
        </div>
         {/supplies}
         {/sales}
         <button type="submit" class="btn btn-primary pull-right">Submit</button>
    </body>
</form>