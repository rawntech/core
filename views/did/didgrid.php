<div id="toolbar-all">
	<a href="config.php?display=did&amp;view=form" class="btn btn-default"><i class="fa fa-plus">&nbsp;<?php echo _("Add Inbound Route")?></i></a>
</div>
<table id="didtable" data-toolbar="#toolbar-all" data-url="ajax.php?module=core&amp;command=getJSON&amp;jdata=allDID" data-cache="false" data-pagination="true" data-search="true" data-toggle="table" class="table table-striped">
	<thead>
					<tr>
					<th data-field="description" data-sortable="true"><?php echo _("Description")?></th>
					<th data-field="cidnum" data-searchable="true" data-sortable="true" data-formatter="DIDnumberFormatter"><?php echo _("CID")?></th>
					<th data-field="extension" data-sortable="true" data-searchable="true" data-formatter="DIDnumberFormatter"><?php echo _("DID")?></th>
					<th data-field="destination" data-formatter="DIDdestFormatter"><?php echo _("Destination")?></th>
					<th data-field="extension" data-formatter="DIDlinkFormatter"><?php echo _("Actions")?></th>
			</tr>
	</thead>
</table>

<script type="text/javascript">
var destinations = <?php echo json_encode(FreePBX::Modules()->getDestinations())?>;
function DIDnumberFormatter(value){
	if(value.length == 0){
		return _("Any");
	}else{
		return decodeURIComponent(value);
	}
}
function DIDdestFormatter(value){
	if(value.length == 0){
		return _("No Destination");
	}else{
		if(typeof destinations[value] !== "undefined") {
			return destinations[value].name + ": " + destinations[value].description;
		} else {
			return value;
		}
	}
}
function DIDlinkFormatter(value, row){
	var html = '<a href="?display=did&view=form&extdisplay='+row['extension']+'%2F'+row['cidnum']+'"><i class="fa fa-pencil"></i></a>';
	html += '&nbsp;<a href="?display=did&action=delIncoming&didfilter=&rnavsort=&extdisplay='+row['extension']+'%2F'+row['cidnum']+'" class="delAction"><i class="fa fa-trash"></i></a>';
	return html;
}
</script>