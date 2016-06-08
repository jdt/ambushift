var $ = require("jquery");
var sprintf = require("sprintf");

var Shifts = 
{
	Messages:
	{
		ConfirmEnrollment: ""
	},

	initialize: function(componentSelector)
	{
		table = $(componentSelector + " table");
		popup = $(componentSelector + " div:first");

		var self = this;
		table.find("a[data-type='enrollButton']").on("click", function(event) {
			var button = $(event.target);
			var message = sprintf(self.Messages.ConfirmEnrollment, {date: button.data("date").toLowerCase(), crewPosition: button.data("crewposition")});
			$(componentSelector).find("span[data-type='shiftEnrollmentMessage']").text(message);
			
			popup.modal("show");
		});
	}
};

module.exports = Shifts;