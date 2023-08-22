<div id="" style="padding-left: 15px">
    <button style="margin:0px; padding:4px; position:absolute; right:1%; top:8px;" type="button" 
    class="bg-light border-radius-sm text-center subMenu" id="subMen" name="subMen">
    <span class="badge badge-pill badge-dark text-success">
        {{--\Cart::getTotalQuantity()--}}
        <i class="fa fa-shopping-cart text-success"></i> {{\Cart::getContent()->count()}}
    </span>
</div>

