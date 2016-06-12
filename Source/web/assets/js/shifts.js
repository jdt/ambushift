var $ = require("jquery");
var sprintf = require("sprintf");
var router = require("./router");

var Shifts = 
{
	Messages:
	{
		ConfirmEnrollment: ""
	},

	initialize: function(componentSelector)
	{
		var table = $(componentSelector + " table");
		var popup = $(componentSelector + " div:first");
		var form = $(componentSelector + " form:first");

		var self = this;
		table.find("a[data-type='enrollButton']").on("click", function(event) {
			var button = $(event.target);
			var message = sprintf(self.Messages.ConfirmEnrollment, {date: button.data("date").toLowerCase(), crewPosition: button.data("crewposition")});
			$(componentSelector).find("span[data-type='shiftEnrollmentMessage']").text(message);
			
			form.attr("action", router.generate("shiftEnrollment", {"crewPositionId": button.data("crewpositionid"), "shiftId": button.data("shiftid")}));
			popup.modal("show");
		});
	}
};

module.exports = Shifts;