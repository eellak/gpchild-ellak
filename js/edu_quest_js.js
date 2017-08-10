jQuery(document).ready(function(){	
			var app = new Vue({
				el: '#edu-quest-results',
				
				data: {
					rows: QUEST_ENTRIES, // this is set on template
					sort_by: 'institution',
					sort_reverse: true,
					filter_type: {
						institution: '',
						department: '',
						course: ''
					}
				},
				
				methods:{
					
					filterType: function(type, key){
						var _that = this

						this.filter_type[type] = key || ''
					},
					
					clearFilter: function(type){
						var _that = this
						this.filter_type[type] = ''
					},
					
					clearFilters: function(){
						var _that = this
						this.filter_type['institution'] = ''
						this.filter_type['department'] = ''
						this.filter_type['course'] = ''
					},
					
					sort: function(key){
						if (this.sort_by === key){
							this.sort_reverse = !this.sort_reverse
						}
						else{
							this.sort_reverse = false
							this.sort_by = key
						}
					}
				},
				
				computed:{
					projects: function(){
						var _that = this
						var p = this.rows

						//sort
						if(this.sort_by === 'institution' || this.sort_by === 'department' || this.sort_by === 'course' || this.sort_by === 'software'){
//							p = _.sortBy(this.rows, function(x){
//								// if the field to be sorted is comprised of many elements,
//								// choose the first for the whole entry to be sorted by.
//								return _.result(x[_that.sort_by], '[0]', '').toLowerCase()
//							})
//						}
//						else{
							p = _.sortBy(this.rows, this.sort_by)
						}

						// filter
						_.forEach(this.filter_type, function(val, type){
							if(val){
								p = _.filter(p, function(x){
									return x[type] && x[type].indexOf(val) > -1
								})
							}
						})
						
						p = this.sort_reverse ? p.reverse() : p
						
						return p

					},
				},
				created: function(){
					if (typeof window.onpopstate !== undefined) {
						var _that = this
						// listen to url history changes
						window.onpopstate = function(e) {
							_that.filter_type = {
								categories: getParameterByName('c', e.state.path) || '',
								locations: getParameterByName('l', e.state.path) || '',
							}
						}
					}
				},
			})
			console.log('inside>e '+app.data.rows)
		})
