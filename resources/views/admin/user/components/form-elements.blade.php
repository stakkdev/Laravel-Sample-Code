<div class="form-group row align-items-center" :class="{'has-danger': errors.has('name'), 'has-success': fields.name && fields.name.valid }">
    <label for="name" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.user.columns.name') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.name" v-validate="'required'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('name'), 'form-control-success': fields.name && fields.name.valid}" id="name" name="name" placeholder="{{ trans('admin.user.columns.name') }}">
        <div v-if="errors.has('name')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('name') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('email'), 'has-success': fields.email && fields.email.valid }">
    <label for="email" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.user.columns.email') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.email" v-validate="'required|email'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('email'), 'form-control-success': fields.email && fields.email.valid}" id="email" name="email" placeholder="{{ trans('admin.user.columns.email') }}">
        <div v-if="errors.has('email')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('email') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('email_verified_at'), 'has-success': fields.email_verified_at && fields.email_verified_at.valid }">
    <label for="email_verified_at" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.user.columns.email_verified_at') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <div class="input-group input-group--custom">
            <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
            <datetime v-model="form.email_verified_at" :config="datetimePickerConfig" v-validate="'date_format:yyyy-MM-dd HH:mm:ss'" class="flatpickr" :class="{'form-control-danger': errors.has('email_verified_at'), 'form-control-success': fields.email_verified_at && fields.email_verified_at.valid}" id="email_verified_at" name="email_verified_at" placeholder="{{ trans('brackets/admin-ui::admin.forms.select_date_and_time') }}"></datetime>
        </div>
        <div v-if="errors.has('email_verified_at')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('email_verified_at') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('password'), 'has-success': fields.password && fields.password.valid }">
    <label for="password" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.user.columns.password') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="password" v-model="form.password" v-validate="'min:7'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('password'), 'form-control-success': fields.password && fields.password.valid}" id="password" name="password" placeholder="{{ trans('admin.user.columns.password') }}" ref="password">
        <div v-if="errors.has('password')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('password') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('password_confirmation'), 'has-success': fields.password_confirmation && fields.password_confirmation.valid }">
    <label for="password_confirmation" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.user.columns.password_repeat') }}</label>
    <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="password" v-model="form.password_confirmation" v-validate="'confirmed:password|min:7'" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('password_confirmation'), 'form-control-success': fields.password_confirmation && fields.password_confirmation.valid}" id="password_confirmation" name="password_confirmation" placeholder="{{ trans('admin.user.columns.password') }}" data-vv-as="password">
        <div v-if="errors.has('password_confirmation')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('password_confirmation') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('profile_picture'), 'has-success': fields.profile_picture && fields.profile_picture.valid }">
    <label for="profile_picture" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.user.columns.profile_picture') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.profile_picture" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('profile_picture'), 'form-control-success': fields.profile_picture && fields.profile_picture.valid}" id="profile_picture" name="profile_picture" placeholder="{{ trans('admin.user.columns.profile_picture') }}">
        <div v-if="errors.has('profile_picture')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('profile_picture') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('social_id'), 'has-success': fields.social_id && fields.social_id.valid }">
    <label for="social_id" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.user.columns.social_id') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.social_id" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('social_id'), 'form-control-success': fields.social_id && fields.social_id.valid}" id="social_id" name="social_id" placeholder="{{ trans('admin.user.columns.social_id') }}">
        <div v-if="errors.has('social_id')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('social_id') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('login_type'), 'has-success': fields.login_type && fields.login_type.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="login_type" type="checkbox" v-model="form.login_type" v-validate="''" data-vv-name="login_type"  name="login_type_fake_element">
        <label class="form-check-label" for="login_type">
            {{ trans('admin.user.columns.login_type') }}
        </label>
        <input type="hidden" name="login_type" :value="form.login_type">
        <div v-if="errors.has('login_type')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('login_type') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('country_code'), 'has-success': fields.country_code && fields.country_code.valid }">
    <label for="country_code" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.user.columns.country_code') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.country_code" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('country_code'), 'form-control-success': fields.country_code && fields.country_code.valid}" id="country_code" name="country_code" placeholder="{{ trans('admin.user.columns.country_code') }}">
        <div v-if="errors.has('country_code')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('country_code') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('phone_number'), 'has-success': fields.phone_number && fields.phone_number.valid }">
    <label for="phone_number" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.user.columns.phone_number') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.phone_number" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('phone_number'), 'form-control-success': fields.phone_number && fields.phone_number.valid}" id="phone_number" name="phone_number" placeholder="{{ trans('admin.user.columns.phone_number') }}">
        <div v-if="errors.has('phone_number')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('phone_number') }}</div>
    </div>
</div>

<div class="form-group row align-items-center" :class="{'has-danger': errors.has('country_iso_code'), 'has-success': fields.country_iso_code && fields.country_iso_code.valid }">
    <label for="country_iso_code" class="col-form-label text-md-right" :class="isFormLocalized ? 'col-md-4' : 'col-md-2'">{{ trans('admin.user.columns.country_iso_code') }}</label>
        <div :class="isFormLocalized ? 'col-md-4' : 'col-md-9 col-xl-8'">
        <input type="text" v-model="form.country_iso_code" v-validate="''" @input="validate($event)" class="form-control" :class="{'form-control-danger': errors.has('country_iso_code'), 'form-control-success': fields.country_iso_code && fields.country_iso_code.valid}" id="country_iso_code" name="country_iso_code" placeholder="{{ trans('admin.user.columns.country_iso_code') }}">
        <div v-if="errors.has('country_iso_code')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('country_iso_code') }}</div>
    </div>
</div>

<div class="form-check row" :class="{'has-danger': errors.has('verified'), 'has-success': fields.verified && fields.verified.valid }">
    <div class="ml-md-auto" :class="isFormLocalized ? 'col-md-8' : 'col-md-10'">
        <input class="form-check-input" id="verified" type="checkbox" v-model="form.verified" v-validate="''" data-vv-name="verified"  name="verified_fake_element">
        <label class="form-check-label" for="verified">
            {{ trans('admin.user.columns.verified') }}
        </label>
        <input type="hidden" name="verified" :value="form.verified">
        <div v-if="errors.has('verified')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('verified') }}</div>
    </div>
</div>


