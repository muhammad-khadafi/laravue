<template>
  <v-container fluid>
    <div class="mt-5 ml-3">
      <h1>Sandbox</h1>
      <h3>area bermain, selamat melakukan eksplorasi</h3>
      <v-form class="mt-3">
        <div class="form-input">
          <p class="label">
            Nama Peran
          </p>
          <input
            v-shortkey.focus="['alt', 'i']"
            class="custom-input"
            type="text"
            placeholder="Input Biasa"
          >
          <v-text-field
            placeholder="v-text-fiels"
            required
            outlined
            class="mt-3"
            @focus="onFocus"
          />
        </div>
      </v-form>
    </div>
  </v-container>
  <v-container fluid>
      <!-- Alternatif 1


        <div class="mt-5 ml-3">
            <h1>Sandbox</h1>
            <h3>area bermain, selamat melakukan eksplorasi</h3>
        </div>
        <div id="trialAutoComplete">
            <v-app id="tes">
                <v-toolbar>
                <v-app-bar-nav-icon class="hidden-sm-and-down"></v-app-bar-nav-icon>
                <v-toolbar-title class="text-h6 mr-6 hidden-sm-and-down">
                    Countries
                </v-toolbar-title>
                <v-autocomplete
                    v-model="model"
                    :items="items"
                    :loading="isLoading"
                    :search-input.sync="search"
                    chips
                    clearable
                    hide-details
                    hide-selected
                    item-text="name.common"
                    item-value="name.common"
                    label="Search for a country"
                    solo
                >
                    <template v-slot:no-data>
                    <v-list-item>
                        <v-list-item-title>
                        Search for your selection country              
                        </v-list-item-title>
                    </v-list-item>
                    </template>
                    <template v-slot:selection="{ attr, on, item, selected }">
                    <v-chip
                        v-bind="attr"
                        :input-value="selected"
                        color="blue-grey"
                        class="white--text"
                        v-on="on"
                    >           
                        <span v-text="item.name.common"></span>
                    </v-chip>
                    </template>
                    <template v-slot:item="{ item }">          
                    <v-list-item-content>
                        <v-list-item-title v-text="item.name.common"></v-list-item-title>            
                    </v-list-item-content>          
                    </template>
                </v-autocomplete>    
                </v-toolbar>
            </v-app>
        </div>

    end of Alternatif 1 -->
    
    <!-- Alternatif 2
    <div>
        <v-app id="inspire">
        <v-toolbar
          dark
          color="teal"
        >
          <v-toolbar-title>State selection</v-toolbar-title>
          <v-autocomplete
            v-model="select"
            :loading="loading"
            :items="items"
            :search-input.sync="search"
            cache-items
            class="mx-4"
            flat
            hide-no-data
            hide-details
            label="Which country are you from?"
            solo-inverted
          ></v-autocomplete>
          <v-btn icon>
            <v-icon>mdi-dots-vertical</v-icon>
          </v-btn>
        </v-toolbar>
      </v-app>
    </div>
    end of alternatif 2 -->

    <div id="app">
      <v-app id="inspire">
        <v-card
          class="overflow-hidden"
          color="purple lighten-1"
          dark
        >
          <v-toolbar
            flat
            color="purple"
          >
            <v-icon>mdi-account</v-icon>
            <v-toolbar-title class="font-weight-light">
              User Profile
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn
              color="purple darken-3"
              fab
              small
              @click="edit"
            >
              <v-icon v-if="isEditing">
                mdi-close
              </v-icon>
              <v-icon v-else>
                mdi-pencil
              </v-icon>
            </v-btn>
          </v-toolbar>
          <v-card-text>
            <v-text-field
              :disabled="!isEditing"
              color="white"
              label="Name"
            ></v-text-field>
            
            <v-autocomplete
                                    
              :disabled="!isEditing"                    
              :search-input.sync="search"
              :items= "items"        
              color="white"
              item-text="name"
              item-value="id"                        
              label="Country"                                  
              hide-details
              hide-no-data
              >
            
            </v-autocomplete>
            
          </v-card-text>
          <v-divider></v-divider>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              :disabled="!isEditing"
              color="success"
              @click="save"
            >
              Save
            </v-btn>
          </v-card-actions>
          <v-snackbar
            v-model="hasSaved"
            :timeout="2000"
            absolute
            bottom
            left
          >
            Your profile has been updated
          </v-snackbar>
        </v-card>
      </v-app>
    </div>
  </v-container>

</template>

<script>

  export default {
    /**
    * alternatif1

    data: () => ({
      isLoading: false,
      items: [],
      model: null,
      search: null,
      tab: null,
    }),

    watch: {
      model (val) {
        if (val != null) this.tab = 0
        else this.tab = null
      },
      search (val) {
              
        if(this.items!=null){
          this.items= []
        }

        if (val.length >= 4){
          this.isLoading = true
        }            

        fetch('https://restcountries.com/v3.1/all/')
          .then(res => res.clone().json())
          .then(res => {
            this.items = res
          })
          .catch(err => {
            console.log(err)
          })
          .finally(() => (this.isLoading = false))
      },
    }, 
    */

    /** alternatif2
    data () {
      return {
        loading: false,
        items: [],
        search: null,
        select: null,
        states: [
          "Afghanistan",
          "Albania",
          "Algeria",
          "American Samoa",
          "Andorra",
          "Angola",
          "Anguilla",
          "Antarctica",
          "Antigua and Barbuda",
          "Argentina",
          "Armenia",
          "Aruba",
          "Australia",
          "Austria",
          "Azerbaijan",
          "Bahamas (the)",
          "Bahrain",
          "Bangladesh",
          "Barbados",
          "Belarus",
          "Belgium",
          "Belize",
          "Benin",
          "Bermuda",
          "Bhutan",
          "Bolivia (Plurinational State of)",
          "Bonaire, Sint Eustatius and Saba",
          "Bosnia and Herzegovina",
          "Botswana",
          "Bouvet Island",
          "Brazil",
          "British Indian Ocean Territory (the)",
          "Brunei Darussalam",
          "Bulgaria",
          "Burkina Faso",
          "Burundi",
          "Cabo Verde",
          "Cambodia",
          "Cameroon",
          "Canada",
          "Cayman Islands (the)",
          "Central African Republic (the)",
          "Chad",
          "Chile",
          "China",
          "Christmas Island",
          "Cocos (Keeling) Islands (the)",
          "Colombia",
          "Comoros (the)",
          "Congo (the Democratic Republic of the)",
          "Congo (the)",
          "Cook Islands (the)",
          "Costa Rica",
          "Croatia",
          "Cuba",
          "Curaçao",
          "Cyprus",
          "Czechia",
          "Côte d'Ivoire",
          "Denmark",
          "Djibouti",
          "Dominica",
          "Dominican Republic (the)",
          "Ecuador",
          "Egypt",
          "El Salvador",
          "Equatorial Guinea",
          "Eritrea",
          "Estonia",
          "Eswatini",
          "Ethiopia",
          "Falkland Islands (the) [Malvinas]",
          "Faroe Islands (the)",
          "Fiji",
          "Finland",
          "France",
          "French Guiana",
          "French Polynesia",
          "French Southern Territories (the)",
          "Gabon",
          "Gambia (the)",
          "Georgia",
          "Germany",
          "Ghana",
          "Gibraltar",
          "Greece",
          "Greenland",
          "Grenada",
          "Guadeloupe",
          "Guam",
          "Guatemala",
          "Guernsey",
          "Guinea",
          "Guinea-Bissau",
          "Guyana",
          "Haiti",
          "Heard Island and McDonald Islands",
          "Holy See (the)",
          "Honduras",
          "Hong Kong",
          "Hungary",
          "Iceland",
          "India",
          "Indonesia",
          "Iran (Islamic Republic of)",
          "Iraq",
          "Ireland",
          "Isle of Man",
          "Israel",
          "Italy",
          "Jamaica",
          "Japan",
          "Jersey",
          "Jordan",
          "Kazakhstan",
          "Kenya",
          "Kiribati",
          "Korea (the Democratic People's Republic of)",
          "Korea (the Republic of)",
          "Kuwait",
          "Kyrgyzstan",
          "Lao People's Democratic Republic (the)",
          "Latvia",
          "Lebanon",
          "Lesotho",
          "Liberia",
          "Libya",
          "Liechtenstein",
          "Lithuania",
          "Luxembourg",
          "Macao",
          "Madagascar",
          "Malawi",
          "Malaysia",
          "Maldives",
          "Mali",
          "Malta",
          "Marshall Islands (the)",
          "Martinique",
          "Mauritania",
          "Mauritius",
          "Mayotte",
          "Mexico",
          "Micronesia (Federated States of)",
          "Moldova (the Republic of)",
          "Monaco",
          "Mongolia",
          "Montenegro",
          "Montserrat",
          "Morocco",
          "Mozambique",
          "Myanmar",
          "Namibia",
          "Nauru",
          "Nepal",
          "Netherlands (the)",
          "New Caledonia",
          "New Zealand",
          "Nicaragua",
          "Niger (the)",
          "Nigeria",
          "Niue",
          "Norfolk Island",
          "Northern Mariana Islands (the)",
          "Norway",
          "Oman",
          "Pakistan",
          "Palau",
          "Palestine, State of",
          "Panama",
          "Papua New Guinea",
          "Paraguay",
          "Peru",
          "Philippines (the)",
          "Pitcairn",
          "Poland",
          "Portugal",
          "Puerto Rico",
          "Qatar",
          "Republic of North Macedonia",
          "Romania",
          "Russian Federation (the)",
          "Rwanda",
          "Réunion",
          "Saint Barthélemy",
          "Saint Helena, Ascension and Tristan da Cunha",
          "Saint Kitts and Nevis",
          "Saint Lucia",
          "Saint Martin (French part)",
          "Saint Pierre and Miquelon",
          "Saint Vincent and the Grenadines",
          "Samoa",
          "San Marino",
          "Sao Tome and Principe",
          "Saudi Arabia",
          "Senegal",
          "Serbia",
          "Seychelles",
          "Sierra Leone",
          "Singapore",
          "Sint Maarten (Dutch part)",
          "Slovakia",
          "Slovenia",
          "Solomon Islands",
          "Somalia",
          "South Africa",
          "South Georgia and the South Sandwich Islands",
          "South Sudan",
          "Spain",
          "Sri Lanka",
          "Sudan (the)",
          "Suriname",
          "Svalbard and Jan Mayen",
          "Sweden",
          "Switzerland",
          "Syrian Arab Republic",
          "Taiwan",
          "Tajikistan",
          "Tanzania, United Republic of",
          "Thailand",
          "Timor-Leste",
          "Togo",
          "Tokelau",
          "Tonga",
          "Trinidad and Tobago",
          "Tunisia",
          "Turkey",
          "Turkmenistan",
          "Turks and Caicos Islands (the)",
          "Tuvalu",
          "Uganda",
          "Ukraine",
          "United Arab Emirates (the)",
          "United Kingdom of Great Britain and Northern Ireland (the)",
          "United States Minor Outlying Islands (the)",
          "United States of America (the)",
          "Uruguay",
          "Uzbekistan",
          "Vanuatu",
          "Venezuela (Bolivarian Republic of)",
          "Viet Nam",
          "Virgin Islands (British)",
          "Virgin Islands (U.S.)",
          "Wallis and Futuna",
          "Western Sahara",
          "Yemen",
          "Zambia",        
          "Zimbabwe",
          "Åland Islands",
        ],
      }
    },
    watch: {
      search (val) {
        
        if (val.length >= 4){
          console.log(this.select)
          val && val !== this.select && this.querySelections(val)  
        }
        
      },
    },
    methods: {
      querySelections (v) {
        this.loading = true
        
        setTimeout(() => {
          this.items = this.states.filter(e => {
            return (e || '').toLowerCase().indexOf((v || '').toLowerCase()) > -1
          })
          this.loading = false
        }, 500)

        
      },
    }, 
    
    */

    
    data () {
      return {
        hasSaved: false,
        isEditing: null,
        items: [],
        model: null,
        search: null,
        states: [
          { name: 'Indonesia', abbr: 'ID', id: 1 },
          { name: 'India', abbr: 'IN', id: 2 },
          { name: 'Japan', abbr: 'JP', id: 3 },
          { name: 'Kazakhstan', abbr: 'KZ', id: 4 },
          { name: 'Malaysia', abbr: 'MY', id: 5 },
        ],
      }
    },

    watch: {    
      
      
      search (val) {
        
        if(this.items!=null){
          this.items = []
        }

        if (val.length >= 4){                
          val && val !== this.select && this.customFilter(this.states, val)  
        }
        
      },
    },
    
    methods: {
      customFilter (item, queryText) {
        this.items = this.states
        
        const searchText = queryText.toLowerCase()                      
        
        return item.indexOf(searchText) > -1 
      },
      
    
      
      save () {
        this.isEditing = !this.isEditing
        this.hasSaved = true      
      },
      
      edit(){
        this.isEditing = !this.isEditing
        
      },
      
      onFocus () {
        this.value = "v-shortkey.focus='['alt', 'b']'"
      },

    },
    

  }
</script>
