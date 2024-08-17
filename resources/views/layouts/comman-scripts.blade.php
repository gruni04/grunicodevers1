<script type="text/javascript">
	function _selectOption(selecter, vals, multiple=0){
        $(selecter).find('option').each(function(){
            var row = $(this);
            if(row.attr('value')==vals){
                row.attr('selected', 'selected');
            }
            else{
                if(multiple==0){
                    row.removeAttr('selected');
                }
            }
        });
    }
</script>