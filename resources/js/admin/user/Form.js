import AppForm from '../app-components/Form/AppForm';

Vue.component('user-form', {
    mixins: [AppForm],
    data: function() {
        return {
            form: {
                name:  '' ,
                email:  '' ,
                email_verified_at:  '' ,
                password:  '' ,
                profile_picture:  '' ,
                social_id:  '' ,
                login_type:  false ,
                country_code:  '' ,
                phone_number:  '' ,
                country_iso_code:  '' ,
                verified:  false ,
                
            }
        }
    }

});