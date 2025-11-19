// Client-side validation and UX for the Student Registration form
(function () {
    function qs(sel, ctx){ return (ctx || document).querySelector(sel); }
    var form = qs('#studentForm');
    if (!form) return;
    var submitBtn = qs('#submitBtn', form);
    var errorsDiv = qs('#formErrors', form);

    function showErrors(list){
        if (!errorsDiv) return;
        if (!list || list.length === 0) {
            errorsDiv.style.display = 'none';
            errorsDiv.innerHTML = '';
            return;
        }
        errorsDiv.style.display = 'block';
        errorsDiv.innerHTML = '<ul style="margin:6px 0 0 18px;">' + list.map(function(i){ return '<li>' + i + '</li>'; }).join('') + '</ul>';
    }

    function validate(){
        var errs = [];
        var name = qs('#name', form).value.trim();
        var roll = qs('#roll', form).value.trim();
        var dept = qs('#department', form).value.trim();
        var email = qs('#email', form).value.trim();

        if (name.length === 0) errs.push('Name is required.');
        if (roll.length === 0) errs.push('Roll number is required.');
        if (dept.length === 0) errs.push('Department is required.');
        if (email.length === 0) errs.push('Email is required.');
        else {
            // simple email check
            var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!re.test(email)) errs.push('Email looks invalid.');
        }

        return errs;
    }

    form.addEventListener('submit', function (e) {
        var errs = validate();
        if (errs.length) {
            e.preventDefault();
            showErrors(errs);
            return false;
        }

        // disable submit to prevent duplicate submits
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.textContent = 'Submitting...';
        }

        // allow normal form submit to server
        return true;
    });

    // live clear errors on input
    ['#name','#roll','#department','#email'].forEach(function(sel){
        var el = qs(sel, form);
        if (!el) return;
        el.addEventListener('input', function(){ showErrors([]); if (submitBtn) { submitBtn.disabled = false; submitBtn.textContent = 'Register Student'; } });
    });
})();