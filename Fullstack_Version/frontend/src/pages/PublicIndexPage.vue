<template>
  <div class="q-my-xl q-mx-auto" style="width:90%;max-width:350px;">
    <div v-if="loginOrReg">
      <q-img
        class="q-mb-lg"
        src="login_top.png"
        spinner-color="white"
        style="width: 100%; height: auto"
      />

      <q-form
        @submit.prevent="onLoginSubmit"
        @reset="loginOrReg=false"
        class="q-gutter-md"
      >
        <q-input
          filled
          clearable
          v-model="login.user"
          :label="$t('publicIndexPage.labels.logName') + ' *'"
          lazy-rules
          :rules="[ 
            val => val && val.length >= 6 || $t('publicIndexPage.rules.logName1'),
            val => val && val.match(/^[a-zA-Z\d.]{6,}$/) || $t('publicIndexPage.rules.logName2'),
            val => val && val.length <= 12 || $t('publicIndexPage.rules.logName3'),
          ]"
          autocomplete="username"
        />

        <q-input
          filled
          v-model="login.pass"
          :label="$t('publicIndexPage.labels.logPass') +' *'"
          lazy-rules
          :rules="[
            val => val && val.length > 0 || $t('publicIndexPage.rules.logPass1'),
          ]"
          :type="isLoginPwd ? 'password' : 'text'"
          autocomplete="current-password"
        >
          <template v-slot:append>
            <q-icon
              :name="isLoginPwd ? 'visibility_off' : 'visibility'"
              class="cursor-pointer"
              @click="isLoginPwd = !isLoginPwd"
            />
          </template>
        </q-input>

        <q-toggle v-model="login.stay" :label="$t('publicIndexPage.html.logOption')" />

        <div>
          <q-btn :label="$t('publicIndexPage.labels.logSubmit')" type="submit" color="primary" class="bg-purple glossy" />
          &nbsp;{{$t('publicIndexPage.html.loqQuestion')}}
          <q-btn :label="$t('publicIndexPage.labels.logRegister')" type="reset" color="primary" flat class="q-ml-sm" />
        </div>
      </q-form>
    </div>

    <div v-if="!loginOrReg">
      <q-img
        class="q-mb-lg"
        src="register_top.png"
        spinner-color="white"
        style="width: 100%; height: auto"
      />

<!-- banner for error or success notif from submit response will be placed here -->

      <q-form
        @submit.prevent="onRegisterSubmit(register)"
        @reset="loginOrReg=true"
        class="q-gutter-md"
      >
        <q-input
          filled
          clearable
          v-model="register.user"
          :label="$t('publicIndexPage.labels.regName') +' *'"
          lazy-rules
          :rules="[ 
            val => val && val.length > 0 || $t('publicIndexPage.rules.regName1'),
            val => val && val.match(/^[a-zA-Z\d.]{6,12}$/)  || $t('publicIndexPage.rules.regName2'),
          ]"
          autocomplete="username"
        />

        <q-input
          filled
          v-model="register.pass"
          :label="$t('publicIndexPage.labels.regPass') +' *'"
          lazy-rules
          :rules="[
            val => val && val.length > 0 || $t('publicIndexPage.rules.regPass1'),
            val => val && val.match(/^[a-zA-Z\d.@#]{6,12}$/)  || $t('publicIndexPage.rules.regPass2'),
          ]"
          :type="isRegPwd ? 'password' : 'text'"
          autocomplete="new-password"
        >
          <template v-slot:append>
            <q-icon
              :name="isRegPwd ? 'visibility_off' : 'visibility'"
              class="cursor-pointer"
              @click="isRegPwd = !isRegPwd"
            />
          </template>
        </q-input>
        <q-input
          filled
          v-model="register.passConfirm"
          :label="$t('publicIndexPage.labels.regPassConf') +' *'"
          lazy-rules
          :rules="[
            val => val && val.length > 0 || $t('publicIndexPage.rules.regPassConf1'),
            val => val && val == register.pass || $t('publicIndexPage.rules.regPassConf2')
          ]"
          :type="isRegPwd ? 'password' : 'text'"
          autocomplete="new-password"
        >
          <template v-slot:append>
            <q-icon
              :name="isRegPwd ? 'visibility_off' : 'visibility'"
              class="cursor-pointer"
              @click="isRegPwd = !isRegPwd"
            />
          </template>
        </q-input>

        <q-input 
          filled
          v-model="register.email"
          :label="$t('publicIndexPage.labels.regEmail') +' *'"
          type="email"
          lazy-rules
          :rules="[
            val => val && val.match(/^[a-zA-Z0-9._]+@[a-zA-Z0-9_.]+\.[a-z]{2,4}$/) || $t('publicIndexPage.rules.regEmail1')
          ]"
        />
        <q-input 
          filled
          v-model="register.emailConf"
          :label="$t('publicIndexPage.labels.regEmailConf') +' *'"
          type="email"
          lazy-rules
          :rules="[
            val => val && val == register.email || $t('publicIndexPage.rules.regEmailConf1')
          ]"
        />

        <q-input 
          class="q-mb-xl"
          filled
          v-model="register.wallet"
          :label="$t('publicIndexPage.labels.regWallet') +' *'"
          :hint="$t('publicIndexPage.labels.regWalletHint')"
          lazy-rules
          :rules="[
            val => val && val.length > 0 || $t('publicIndexPage.rules.regWallet1'),
            val => val && val.match(/^[a-zA-Z0-9]{12,}$/) || $t('publicIndexPage.rules.regWallet2')
          ]"
        />

        <q-select
          filled
          v-model="register.country"
          use-input
          input-debounce="0"
          :label="$t('publicIndexPage.labels.regCountry') +' *'"
          :options="country.visible"
          @filter="filterFn"
          behavior="menu"
          lazy-rules
          :rules="[ 
            val => val && val.length > 0 || $t('publicIndexPage.rules.regCountry1'),
          ]"
        >
          <template v-slot:no-option>
            <q-item>
              <q-item-section class="text-grey">
                {{$t('publicIndexPage.html.regNoCountry')}}
              </q-item-section>
            </q-item>
          </template>
        </q-select>

        <q-input
          filled
          clearable
          v-model="register.key"
          :label="$t('publicIndexPage.labels.regKey') +' *'"
          lazy-rules
          :rules="[ 
            val => val && val.length > 0 || $t('publicIndexPage.rules.regKey1'),
            val => val && val.match(/^[a-zA-Z\d]{6,12}$/)  || $t('publicIndexPage.rules.regKey2'),
          ]"
        />
        <q-input
          filled
          clearable
          v-model="register.keyConf"
          :label="$t('publicIndexPage.labels.regKeyConf') +' *'"
          lazy-rules
          :rules="[ 
            val => val && val == register.key || $t('publicIndexPage.rules.regKeyConf1'),
          ]"
        />

        <q-input 
          filled 
          bottom-slots 
          v-model="register.captcha" 
          :label="$t('publicIndexPage.labels.regCaptcha')"
          maxlength="6" 
          lazy-rules="ondemand"
          :rules="[ 
            val => val && val.length > 0 || $t('publicIndexPage.rules.regCaptcha1'),
            val => validateCaptcha(val) || $t('publicIndexPage.rules.regCaptcha2'),
          ]"
        >
          <template v-slot:after>
            <q-avatar style="width:116px;height:40px;">
              <img :src="captchaStore.getCaptcha">
            </q-avatar>
          </template>
        </q-input>
        


        <div>
          <q-btn :label="$t('publicIndexPage.labels.regSubmit')" type="submit" color="primary" class="bg-purple glossy" />
          &nbsp;{{$t('publicIndexPage.html.regQuestion')}}
          <q-btn :label="$t('publicIndexPage.labels.regLogin')" type="reset" color="primary" flat class="q-ml-sm" />
        </div>
      </q-form>
    </div>
  </div>
</template>

<script setup lang="ts">
  import { reactive } from 'vue';
  import { useI18n } from 'vue-i18n'
  import { PublicIndexPage } from 'pages/composables/PublicIndexPage'
  import { useCaptchaStore } from 'stores/captcha-store'

  const { t: $t } = useI18n({ useScope: 'global' })
  const {
    loginOrReg,
    isLoginPwd,
    isRegPwd,
    register,
    onRegisterSubmit,
    getCaptcha,
    validateCaptcha,
  } = PublicIndexPage();
  const captchaStore = useCaptchaStore();

  getCaptcha();






  // For retrieving user-submitted data from the login screen
  interface Login {
    user: string
    pass: string
    stay: boolean
  }
  const login: Login = reactive({
    user: '',
    pass: '',
    stay: false,
  })
  const onLoginSubmit = () => {
    console.log(login)
  }

  

  // For searching the country for selected option
  interface Country {
    all: []
    visible?: []
  }
  const country: Country = reactive({
    all: [
      'Afghanistan',
      'Albania',
      'Algeria',
      'American Samoa',
      'Andorra',
      'Angola',
      'Anguilla',
      'Antarctica',
      'Antigua and Barbuda',
      'Argentina',
      'Armenia',
      'Aruba',
      'Australia',
      'Austria',
      'Azerbaijan',
      'Bahamas (the)',
      'Bahrain',
      'Bangladesh',
      'Barbados',
      'Belarus',
      'Belgium',
      'Belize',
      'Benin',
      'Bermuda',
      'Bhutan',
      'Bolivia (Plurinational State of)',
      'Bonaire, Sint Eustatius and Saba',
      'Bosnia and Herzegovina',
      'Botswana',
      'Bouvet Island',
      'Brazil',
      'British Indian Ocean Territory (the)',
      'Brunei Darussalam',
      'Bulgaria',
      'Burkina Faso',
      'Burundi',
      'Cabo Verde',
      'Cambodia',
      'Cameroon',
      'Canada',
      'Cayman Islands (the)',
      'Central African Republic (the)',
      'Chad',
      'Chile',
      'China',
      'Christmas Island',
      'Cocos (Keeling) Islands (the)',
      'Colombia',
      'Comoros (the)',
      'Congo (the Democratic Republic of the)',
      'Congo (the)',
      'Cook Islands (the)',
      'Costa Rica',
      'Croatia',
      'Cuba',
      'Curaçao',
      'Cyprus',
      'Czechia',
      'Côte d’Ivoire',
      'Denmark',
      'Djibouti',
      'Dominica',
      'Dominican Republic (the)',
      'Ecuador',
      'Egypt',
      'El Salvador',
      'Equatorial Guinea',
      'Eritrea',
      'Estonia',
      'Eswatini',
      'Ethiopia',
      'Falkland Islands (the) [Malvinas]',
      'Faroe Islands (the)',
      'Fiji',
      'Finland',
      'France',
      'French Guiana',
      'French Polynesia',
      'French Southern Territories (the)',
      'Gabon',
      'Gambia (the)',
      'Georgia',
      'Germany',
      'Ghana',
      'Gibraltar',
      'Greece',
      'Greenland',
      'Grenada',
      'Guadeloupe',
      'Guam',
      'Guatemala',
      'Guernsey',
      'Guinea',
      'Guinea-Bissau',
      'Guyana',
      'Haiti',
      'Heard Island and McDonald Islands',
      'Holy See (the)',
      'Honduras',
      'Hong Kong',
      'Hungary',
      'Iceland',
      'India',
      'Indonesia',
      'Iran (Islamic Republic of)',
      'Iraq',
      'Ireland',
      'Isle of Man',
      'Israel',
      'Italy',
      'Jamaica',
      'Japan',
      'Jersey',
      'Jordan',
      'Kazakhstan',
      'Kenya',
      'Kiribati',
      'Korea (the Democratic People’s Republic of)',
      'Korea (the Republic of)',
      'Kuwait',
      'Kyrgyzstan',
      'Lao People’s Democratic Republic (the)',
      'Latvia',
      'Lebanon',
      'Lesotho',
      'Liberia',
      'Libya',
      'Liechtenstein',
      'Lithuania',
      'Luxembourg',
      'Macao',
      'Madagascar',
      'Malawi',
      'Malaysia',
      'Maldives',
      'Mali',
      'Malta',
      'Marshall Islands (the)',
      'Martinique',
      'Mauritania',
      'Mauritius',
      'Mayotte',
      'Mexico',
      'Micronesia (Federated States of)',
      'Moldova (the Republic of)',
      'Monaco',
      'Mongolia',
      'Montenegro',
      'Montserrat',
      'Morocco',
      'Mozambique',
      'Myanmar',
      'Namibia',
      'Nauru',
      'Nepal',
      'Netherlands',
      'New Caledonia',
      'New Zealand',
      'Nicaragua',
      'Niger',
      'Nigeria',
      'Niue',
      'Norfolk Island',
      'Northern Mariana Islands',
      'Norway',
      'Oman',
      'Pakistan',
      'Palau',
      'Palestine, State of',
      'Panama',
      'Papua New Guinea',
      'Paraguay',
      'Peru',
      'Philippines',
      'Pitcairn',
      'Poland',
      'Portugal',
      'Puerto Rico',
      'Qatar',
      'Republic of North Macedonia',
      'Romania',
      'Russian Federation',
      'Rwanda',
      'Réunion',
      'Saint Barthélemy',
      'Saint Helena, Ascension and Tristan da Cunha',
      'Saint Kitts and Nevis',
      'Saint Lucia',
      'Saint Martin (French part)',
      'Saint Pierre and Miquelon',
      'Saint Vincent and the Grenadines',
      'Samoa',
      'San Marino',
      'Sao Tome and Principe',
      'Saudi Arabia',
      'Senegal',
      'Serbia',
      'Seychelles',
      'Sierra Leone',
      'Singapore',
      'Sint Maarten (Dutch part)',
      'Slovakia',
      'Slovenia',
      'Solomon Islands',
      'Somalia',
      'South Africa',
      'South Georgia and the South Sandwich Islands',
      'South Sudan',
      'Spain',
      'Sri Lanka',
      'Sudan (the)',
      'Suriname',
      'Svalbard and Jan Mayen',
      'Sweden',
      'Switzerland',
      'Syrian Arab Republic',
      'Taiwan',
      'Tajikistan',
      'Tanzania, United Republic of',
      'Thailand',
      'Timor-Leste',
      'Togo',
      'Tokelau',
      'Tonga',
      'Trinidad and Tobago',
      'Tunisia',
      'Turkey',
      'Turkmenistan',
      'Turks and Caicos Islands',
      'Tuvalu',
      'Uganda',
      'Ukraine',
      'United Arab Emirates (UAE)',
      'United Kingdom of Great Britain and Northern Ireland',
      'United States Minor Outlying Islands',
      'United States of America (USA)',
      'Uruguay',
      'Uzbekistan',
      'Vanuatu',
      'Venezuela (Bolivarian Republic of)',
      'Viet Nam',
      'Virgin Islands (British)',
      'Virgin Islands (U.S.)',
      'Wallis and Futuna',
      'Western Sahara',
      'Yemen',
      'Zambia',
      'Zimbabwe',
      'Åland Islands'
    ]})
  country.visible = country.all
  const filterFn = (val, update) => {
    if (val === '') {
      update(() => {
        country.visible = country.all
      })
      return
    }
    update(() => {
      const needle = val.toLowerCase()
      country.visible = country?.all.filter(v => v.toLowerCase().indexOf(needle) > -1)
    })
  }

</script>
