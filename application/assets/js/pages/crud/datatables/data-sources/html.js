"use strict";
var KTDatatablesDataSourceHtml = {
	init: function () {
		$("#kt_datatable").DataTable({
			responsive: !0,
		})
	}
};
jQuery(document).ready((function () {
	KTDatatablesDataSourceHtml.init()
}));