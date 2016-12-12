<body id="receiving" class="probody">
    <form method="post" action="/receiving/update" id="receivingForm">
        {receiving}
        <h2>Received Supplies</h2>
        <hr>
        <div class='row'>
            {supplies}
            <div class="col-md-2">
                <input id="item-name" class="form-control" value="{name}" onfocus="this.blur()"/>
                <input name="selectedItem[{id}]" id="focusedInput" class="form-control" type="number" min="0" placeholder="Enter Value" autocomplete="off"/>
            </div>
            {/supplies}
        </div>
        {/receiving}
        <input type="submit" value="selectedItem" class="btn btn-primary pull-right">
    </form>
</body>

