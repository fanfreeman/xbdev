/*1336802065,176820662*/

if (window.CavalryLogger) { CavalryLogger.start_js(["8SiZg"]); }

__d("TypeaheadExactMatchFirst",["copyProperties"],function(a,b,c,d,e,f){var g=b('copyProperties');function h(i){this._typeahead=i;}g(h.prototype,{_subscription:null,enable:function(){var i=this._typeahead.getView();this._subscription=i.subscribe('beforeRender',function(j,k){var l=false;k.results.each(function(n,o){if(n.text===k.value){l=o;return;}});if(l){var m=k.results.splice(l,1);k.results.unshift(m[0]);}});},disable:function(){var i=this._typeahead.getView();i.unsubscribe(this._subscription);this._subscription=null;}});e.exports=h;});
__d("legacy:ExactMatchFirstTypeaheadBehavior",["TypeaheadExactMatchFirst"],function(a,b,c,d){var e=b('TypeaheadExactMatchFirst');if(!a.TypeaheadBehaviors)a.TypeaheadBehaviors={};a.TypeaheadBehaviors.ExactMatchFirstTypeahead=function(f){f.enableBehavior(e);};},3);
function addHoverClass(a){Event.listen(a,'mouseover',function(){CSS.addClass(a,'hovered');});Event.listen(a,'mouseout',function(){CSS.removeClass(a,'hovered');});}
function SortableSideNav(a,b,c,d){this.list=a;this.inEdit=false;this.sortables={};this.endpoint=b;this.divider=DOM.scry(a,'li.divider')[0];this.visible=a.childNodes.length;this.sortableGroup=null;this.linked=[];this.droppable=c===undefined?true:c;this.oneCommit=d||false;if(this.divider)for(var e=0;e<this.visible;e++)if(a.childNodes[e]==this.divider){this.visible=e;break;}}copy_properties(SortableSideNav.prototype,{inEditMode:function(){return this.inEdit;},beginEdit:function(){this.createSortableGroup();this.dragToken=Event.listen(this.list,'click',this.onClick.bind(this));this.inEdit=true;},endEdit:function(){if(this.droppable&&this.oneCommit)new AsyncRequest().setURI(this.endpoint).setData({ids:this.sortableGroup.getOrder()}).send();this.destroySortableGroup();if(this.divider&&this.visible<this.list.childNodes.length){DOM.remove(this.divider);DOM.insertAfter(this.list.childNodes[this.visible-1],this.divider);var a=$A(this.list.childNodes),b=a.indexOf(this.divider);for(var c=1,d=a.length;c<d;c++){var e=a[c];if(e===this.divider)continue;CSS.conditionClass(e,'hidden',c>b);}}this.dragToken.remove();this.inEdit=false;},isDroppable:function(){return this.droppable;},setDraggable:function(a){for(var b=0;b<this.linked.length;b++)if(!this.linked[b].isDroppable())this.linked[b].getSortableGroup().setDraggable(a);},createSortableGroup:function(){this.sortables={};for(var a=0;a<this.list.childNodes.length;a++)if(this.list.childNodes[a]!=this.divider&&DOM.scry(this.list.childNodes[a],'span.mover').length)this.sortables[this.list.childNodes[a].id.replace('navItem_','')]=this.list.childNodes[a];this.sortableGroup=new SortableGroup().setBeforeGrabCallback(this.beforeGrab.bind(this)).setGrabCallback(this.onGrab.bind(this)).setDropCallback(this.onDrop.bind(this)).setOrderChangeHandler(this.onReorder.bind(this)).setDroppable(this.droppable);for(var b in this.sortables)this.sortableGroup.addSortable(b,this.sortables[b]);},resetSortableGroup:function(){this.destroySortableGroup();this.createSortableGroup();var a=this.linked;this.linked=[];for(var b=0;b<a.length;b++)this.linkNav(a[b]);},destroySortableGroup:function(){this.sortableGroup.destroy();},getRoot:function(){return this.list;},getSortableGroup:function(){if(!this.sortableGroup)this.createSortableGroup();return this.sortableGroup;},linkNav:function(a){if(!this.linked.length)this.linked.push(this);if(this.linked.indexOf(a)===-1){for(var b=0;b<this.linked.length;b++)this.linked[b].getSortableGroup().link(a.getSortableGroup());this.linked.push(a);a.linked=this.linked;}},beforeGrab:function(){this.resetBounds();},onGrab:function(a){var b=parseInt(CSS.getStyle(a,'paddingRight'),10)+parseInt(CSS.getStyle(a,'paddingLeft'),10),c=Vector2.getElementDimensions(a).x-b;CSS.setStyle(a,'opacity',.7);CSS.setStyle(a,'width',c+"px");CSS.setStyle(a,'zIndex',1);this.draggingItem=a;for(var d=0;d<this.linked.length;d++)CSS.addClass(this.linked[d].getRoot(),'draggingMode');},onDrop:function(a,b){if(!b)b=this.draggingItem;CSS.setStyle(b,'opacity',1);CSS.setStyle(b,'width','');CSS.setStyle(b,'zIndex','');this.draggingItem=null;for(var c=0;c<this.linked.length;c++)CSS.removeClass(this.linked[c].getRoot(),'draggingMode');},onReorder:function(){if(!this.oneCommit)new AsyncRequest().setURI(this.endpoint).setData({ids:this.sortableGroup.getOrder()}).setHandler(bagofholding).send();},onClick:function(event){var a=event.getTarget();if(CSS.hasClass(a,'arrow')){this.onMove(a);}else if(DOM.isNodeOfType(a,['input','label']))this.onRemove(a,event.clientX===0);},onMove:function(a){if(CSS.hasClass(a,'up')){this.moveItem(a,'up');}else if(CSS.hasClass(a,'down'))this.moveItem(a,'down');},onRemove:function(a,b){var c=Parent.byTag(a,'li');CSS.hide(c);this.resetSortableGroup(c);if(!b)return;if(c.nextSibling){DOM.find(c.nextSibling,'a.item').focus();}else if(c.previousSibling)DOM.find(c.previousSibling,'a.item').focus();},moveItem:function(a,b){var c=Parent.byTag(a,'li'),d=b=='up'?c.previousSibling:c.nextSibling;if(d==this.divider)d=b=='up'?d.previousSibling:d.nextSibling;if(d&&values(this.sortables).indexOf(d)!=-1){b=='up'?DOM.insertBefore(d,c):DOM.insertAfter(d,c);this.onReorder();a.focus();}},resetBounds:function(){if(this.isDroppable()&&this.sortables){var a=this.sortableGroup.getOrder(),b=this.sortableGroup.hasEmptyMessage?2:1,c=$('navItem_'+a[0]),d=$('navItem_'+a[a.length-b]),e=new Rect(Vector2.getElementPosition(c).y,0,Vector2.getElementPosition(d).y+d.offsetHeight,0);this.sortableGroup.setBoundingBox(e);}}});
function OGToolSortableList(a,b,c,d){var e=$(c),f=$(d),g=function(){};g.prototype=new SortableSideNav(a,b,true,false);copy_properties(g.prototype,{resetBounds:function(){var h=new Rect(a);this.sortableGroup.setBoundingBox(h);}});this.sortableNav=new g();Event.listen(e,'click',function(){this.sortableNav.beginEdit();CSS.addClass(a,"editMode");CSS.hide(e);CSS.show(f);}.bind(this));Event.listen(f,'click',function(){this.sortableNav.endEdit();CSS.removeClass(a,"editMode");CSS.show(e);CSS.hide(f);}.bind(this));}
__d("LayerPage",["AccessibleLayer","Arbiter","Class","CSS","DOM","Layer","LayerButtons","LayerFormHooks","LayerHideOnCancel","LayerHideOnTransition","LayerMouseHooks","ModalLayer","Style","UserAgent","Vector","copyProperties"],function(a,b,c,d,e,f){var g=b("AccessibleLayer"),h=b("Arbiter"),i=b("Class"),j=b("CSS"),k=b("DOM"),l=b("Layer"),m=b("LayerButtons"),n=b("LayerFormHooks"),o=b("LayerHideOnCancel"),p=b("LayerHideOnTransition"),q=b("LayerMouseHooks"),r=b("ModalLayer"),s=b("Style"),t=b("UserAgent"),u=b("Vector"),v=b("copyProperties");function w(z,aa){this.parent.construct(this,z,aa);}i.extend(w,l);var x=15;v(w.prototype,{_width:null,_configure:function(z,aa){if(z.width)this._width=Math.floor(z.width);this.parent._configure(z,aa);},_getDefaultBehaviors:function(){return this.parent._getDefaultBehaviors().concat([y,g,m,o,p,q,n,r]);},updatePosition:function(){var z=k.find(this.getRoot(),'div.uiLayerPage');if(this._width){var aa=k.find(z,'div.uiLayerPageContent'),ba=this._width;if(j.hasClass(aa,'uiLayerPageDefaultPadding'))ba+=2*x;var ca=Math.floor(ba/-2);s.set(z,'margin-left',ca+'px');s.set(z,'width',ba+'px');}if(t.ie()<7)s.set(z,'top',u.getScrollPosition().y+'px');return true;}});function y(z){this._layer=z;}v(y.prototype,{_subscription:null,enable:function(){this._subscription=this._layer.subscribe(['show','hide'],function(z,aa){if(z==='show'){h.inform('layer_shown',{type:'LayerPage'});}else h.inform('layer_hidden',{type:'LayerPage'});});},disable:function(){this._layer.unsubscribe(this._subscription);this._subscription=null;}});e.exports=w;});
__d("legacy:drag",["Draggable","Droppable"],function(a,b,c,d){a.Draggable=b('Draggable');a.Droppable=b('Droppable');},3);
__d("DimensionTracking",["event-extensions","AsyncSignal","Cookie","DOMDimensions","Run"],function(a,b,c,d,e,f){b("event-extensions");var g=b("AsyncSignal"),h=b("Cookie"),i=b("DOMDimensions"),j=b("Run");function k(){var l=i.getViewportDimensions();h.set('wd',l.width+'x'+l.height);if(Math.random()<.01)new g('/ajax/dimension_context.php',{x:l.width,y:l.height}).send();}if(window==window.top)j.onAfterLoad(function(){setTimeout(k,100);Event.listen(window,'resize',k);Event.listen(window,'focus',k);});});
function UIAdmgrPageViewReport(a,b,c,d){this.reportParams=b;this.topDiv=$('contentArea');this.date_picker=d;this.date_picker.setCallback(this._dateChangeCallback.bind(this));this.summary_bar_container=DOM.scry(this.topDiv,'div.adreports_summary_bar')[0];this.table_container=DOM.find(this.topDiv,'div.adreports_data');this._initializeColumnHeaders(c);this._findButtons();}copy_properties(UIAdmgrPageViewReport,{DATA_ENDPOINT:'/ads/ajax/reports_get_data.php'});copy_properties(UIAdmgrPageViewReport.prototype,{_dateChangeCallback:function(a,b,c,d,e){new BakerAction(null,'input;ads:manage:reports;changeDate').log();if(b==d&&c==e){a.confirmSave(b,c);return;}var f=this.overrideDateParams(this.reportParams,b,c);this.oldStartText=d;this.oldEndText=e;new AsyncRequest().setURI(UIAdmgrPageViewReport.DATA_ENDPOINT).setData(f).setErrorHandler(function(g){a.confirmSave(this.oldStartText,this.oldEndText);}.bind(this)).setHandler(function(g){if(g.payload.err){a.confirmSave(this.oldStartText,this.oldEndText);Arbiter.inform(UIAdmgrHeaderMessaging.ARBITER_ERROR_MESSAGE,[g.payload.err]);return;}this.reportParams=f;if(this.table_container&&g.payload.table_html)DOM.setContent(this.table_container,HTML(g.payload.table_html));if(this.summary_bar_container&&g.payload.summary_html)DOM.setContent(this.summary_bar_container,HTML(g.payload.summary_html));this.updateButtonLinks(b,c);this._initializeColumnHeaders(g.payload.columns);a.confirmSave(b,c);Arbiter.inform(UIAdmgrHeaderMessaging.ARBITER_ERROR_MESSAGE,g.payload.errors);}.bind(this)).setStatusElement('adreports_table_loading').send();a.confirmSave(b,c);},_initializeColumnHeaders:function(a){for(var b in a){var c=a[b],d=DOM.find(this.topDiv,'th#dtth_'+c.tableIndex);Event.listen(d,'click',this._columnHeaderClickCallback.bind(this,c.logName));}},_columnHeaderClickCallback:function(a){var b='input;ads:manage:reports:sort;'+a;new BakerAction(null,b).log();console.log(b);},_findButtons:function(){this.buttons=[];this.export_buttons=DOM.scry(this.topDiv,'a.exportReportButton');this.new_report_buttons=DOM.scry(this.topDiv,'a.newReportButton');this.schedule_buttons=DOM.scry(this.topDiv,'a.scheduleReportButton');this.buttons=this.buttons.concat(this.export_buttons);this.buttons=this.buttons.concat(this.new_report_buttons);this.buttons=this.buttons.concat(this.schedule_buttons);},updateButtonLinks:function(a,b){for(var c=0;c<this.buttons.length;c++){var d=new URI(this.buttons[c].href),e=d.getQueryData();d.setQueryData(this.overrideDateParams(e,a,b));this.buttons[c].href=d.toString();}},overrideDateParams:function(a,b,c){var d=a;if("0"===b){d.time_start=0;d.time_end=0;}else{d.time_start=null;d.time_end=null;}switch(d.agg_time){case 'daily':case 'custom':d.day_start_text_field=b;d.day_end_text_field=c;break;case 'weekly':d.week_start_text_field=b;d.week_end_text_field=c;break;case 'monthly':newStartFields=b.split('/');newEndFields=c.split('/');d.month_start_month=newStartFields[0];d.month_start_year=newStartFields[2];d.month_end_month=newEndFields[0];d.month_end_year=newEndFields[2];break;}return d;}});
function delay_add_class(a,b){var c='hovered',d=250,e=null,f=null,g=function(i){if(!DOM.contains(a,i.getTarget())){clearTimeout(e);CSS.removeClass(a,c);f&&f.remove();}},h=function(){e=setTimeout(CSS.addClass.bind(null,a,c),d||0);f=Event.listen(document,'mousemove',g);};Event.listen(a,'mouseenter',h);if(DOM.contains(a,$E(b).getTarget()))h();}
function SortTable(a,b,c,d,e,f,g,h){copy_properties(this,{_table:a,_needsSwitch:false,_startRow:0,_sortColumnIndex:null,_firstRow:null,_defaultColumnId:c,_defaultDir:b?'down':'up',_comparisonColumn:[],_comparisonTransitions:{},_footerRows:d||0,_stripe:e||true,_stripeClass:f||'alt',_stripeInterval:g||2,_stripeOffset:h||0});this._init();return this;}copy_properties(SortTable,{tablesByID:{}});copy_properties(SortTable.prototype,{_numberRE:/^([+-]?[\d\.\,]+)\s*([KMBGT%]|us|ms|s|m|h|d|w|y|MB|GB|GiB|TB|PB|EB|YB|ZB|MiB\/sec|Mb\/s|Gb\/s|Tb\/s|\/sec)?\s*\(?(\s*[\d\.]+%?\s*)?\)?/,_sortTransitions:{down:'up',up:'down'},_arrowContent:{down:'&nbsp;&uarr;&nbsp',up:'&nbsp;&darr;&nbsp',down_changes:'&nbsp;&uarr;&divide;&nbsp',up_changes:'&nbsp;&darr;&divide;&nbsp'}});copy_properties(SortTable.prototype,{_init:function(){SortTable.tablesByID[this._table.id]=this;var a;for(var b=0;b<this._table.rows.length;b++){a=this._table.rows[b];if(CSS.hasClass(a,'title')){this._startRow=b+1;a=null;continue;}else break;}if(!a)return;var c=this._sortTransitions[this._defaultDir],d=this._defaultDir+'_changes',e=c+'_changes';this._comparisonTransitions[d]=e;this._comparisonTransitions[e]=this._defaultDir;this._comparisonTransitions[this._defaultDir]=c;this._comparisonTransitions[c]=d;this._firstRow=a;for(var b=0;b<a.cells.length;b++){var f=a.cells[b];this._comparisonColumn[b]=CSS.hasClass(f,'comparison');if(CSS.hasClass(f,'sortable')){var g=this._defaultDir;if(this._comparisonColumn[b])g+='_changes';f.appendChild(this._makeArrow(g));CSS.addClass(f,'sortheader');Event.listen(f,'click',bind(this,this._resort,b));}}if(this._defaultColumnId!=null)this._resort(this._defaultColumnId);for(var h=this._startRow+1;h<this._table.rows.length;h++)if(CSS.hasClass(this._table.rows[h],'sticktotop')){this._startRow=h;continue;}else break;},_resort:function(a){this._needsSwitch=false;var b=DOM.scry(this._firstRow,'span.sortarrow'),c=b[a],d=1+this._startRow,e='';while(e==''&&d<this._table.rows.length){e=DOM.getText(this._table.rows[d].cells[a]);e=e.replace(/,/g,'');d++;}if(e=='')return;var f=c.getAttribute('sortdir'),g=bind(this,this._sortCaseinsensitive),h=this._table.rows[this._startRow+1];if(h.cells[a].getAttribute('data-raw')){g=bind(this,this._sortDataRaw);}else if(e.match(/^\d\d[\/-]\d\d[\/-]\d\d\d\d/)){g=bind(this,this._sortDate1);}else if(e.match(/^\d\d[\/-]\d\d[\/-]\d\d/)){g=bind(this,this._sortDate2);}else if(e.match(/^\d\d[\/-]\d\d \d\d?:\d\d [ap]m/)){g=bind(this,this._sortDate3);}else if(e.match(/^\d\d\d\d[\/\-]\d\d[\/\-]\d\d/)){g=bind(this,this._sortDate4);}else if(e.match(/^[\xa3$]/)){g=bind(this,this._sortCurrency);}else if(e.match(this._numberRE)){if(f=='up_changes'||f=='down_changes'){g=bind(this,this._sortNumericChanges);}else g=bind(this,this._sortNumeric);}else if(!isNaN(Date.parse(e)))g=bind(this,this._sortDate4);var i=[],j=[],k=this._startRow+1;for(var l=k;l<this._table.rows.length;l++)if(l<this._table.rows.length-this._footerRows){i[l-k]=this._table.rows[l];}else{var m=l-(this._table.rows.length-this._footerRows);j[m]=this._table.rows[l];}this._sortColumnIndex=a;i.sort(g);if(f=='down'||f=='down_changes')i.reverse();var n=null;if(this._comparisonColumn[a]){n=this._comparisonTransitions[f];}else n=this._sortTransitions[f];this._setArrow(c,n);for(var o=0;o<b.length;o++)CSS.addClass(b[o],'invisible');CSS.removeClass(c,'invisible');var p;for(o=0;o<i.length;o++){p=this._stripe&&((o+this._stripeOffset)%Math.max(1,this._stripeInterval)===0);if(p){CSS.addClass(i[o],this._stripeClass);}else CSS.removeClass(i[o],this._stripeClass);this._table.tBodies[0].appendChild(i[o]);}for(o=0;o<this._footerRows;o++)this._table.tBodies[0].appendChild(j[o]);},_makeArrow:function(a){var b=$N('span',{className:'sortarrow invisible'},'');b.setAttribute('sortdir',a);return b;},_setArrow:function(a,b){var c=a.getAttribute('sortdir');DOM.setContent(a,HTML(this._arrowContent[c]));a.setAttribute('sortdir',b);},getSortColumnIndex:function(){return this._sortColumnIndex;},_sortDate1:function(a,b){var c=DOM.getText(a.cells[this._sortColumnIndex]),d=DOM.getText(b.cells[this._sortColumnIndex]),e=c.substr(6,4)+c.substr(0,2)+c.substr(3,2)+c.substr(10),f=d.substr(6,4)+d.substr(0,2)+d.substr(3,2)+d.substr(10);if(e==f)return 0;if(e<f)return -1;return 1;},_sortDate2:function(a,b){var c=DOM.getText(a.cells[this._sortColumnIndex]),d=DOM.getText(b.cells[this._sortColumnIndex]),e=c.substr(6,2);if(parseInt(e)<50){e='20'+e;}else e='19'+e;var f=e+c.substr(0,2)+c.substr(3,2)+c.substr(8);e=d.substr(6,2);if(parseInt(e)<50){e='20'+e;}else e='19'+e;var g=e+d.substr(0,2)+d.substr(3,2)+d.substr(8);if(f==g)return 0;if(f<g)return -1;return 1;},_sortDate3:function(a,b){var c=DOM.getText(a.cells[this._sortColumnIndex]),d=DOM.getText(b.cells[this._sortColumnIndex]),e=c.match(/^(\d\d)[\/-](\d\d) (\d\d?):(\d\d) ([ap]m)/),f=d.match(/^(\d\d)[\/-](\d\d) (\d\d?):(\d\d) ([ap]m)/),g=e[1]+e[2],h=f[1]+f[2];if(g<h)return -1;if(g>h)return 1;var i=(parseInt(e[3])+(e[5]=='pm'?12:0))*60+parseInt(e[4]),j=(parseInt(f[3])+(f[5]=='pm'?12:0))*60+parseInt(f[4]);if(i==j)return 0;if(i<j)return -1;return 1;},_sortDate4:function(a,b){var c=DOM.getText(a.cells[this._sortColumnIndex]),d=DOM.getText(b.cells[this._sortColumnIndex]),e=Date.parse(c),f=Date.parse(d);if(e==f)return 0;if(e<f)return -1;return 1;},_sortCurrency:function(a,b){var c=DOM.getText(a.cells[this._sortColumnIndex]).replace(/[^0-9.]/g,''),d=DOM.getText(b.cells[this._sortColumnIndex]).replace(/[^0-9.]/g,'');return parseFloat(c)-parseFloat(d);},_getCountValue:function(a){a=a.replace(/,/g,'');count_re=this._numberRE;match=count_re.exec(a);if(!match)return null;value=parseFloat(match[1]);switch(match[2]){case 'YB':return value*1048576*1048576*1048576*1048576;case 'ZB':return value*1048576*1048576*1048576*1024;case 'EB':return value*1048576*1048576*1048576;case 'PB':return value*1048576*1048576*1024;case 'T':return value*1e+06*1e+06;case 'B':case 'G':return value*1e+06*1000;case 'TB':case 'Tb/s':return value*1048576*1048576;case 'M':case 's':return value*1e+06;case 'GB':case 'Gb/s':case 'GiB':return value*1048576*1024;case 'K':case 'ms':return value*1000;case 'MB':case 'Mb/s':case 'MiB/sec':return value*1048576;case 'm':return value*1e+06*60;case 'h':return value*1e+06*3600;case 'd':return value*1e+06*86400;case 'w':return value*1e+06*86400*7;case 'y':return value*1e+06*86400*7*52;case 'us':return value;default:return value;}},_sortNumeric:function(a,b){var c=this._getCountValue(DOM.getText(a.cells[this._sortColumnIndex]));if(isNaN(c))c=0;var d=this._getCountValue(DOM.getText(b.cells[this._sortColumnIndex]));if(isNaN(d))d=0;return c-d;},_getChangeRatio:function(a){var b=null,c=null,d=DOM.scry(a,'.pri');if(d.length>0){b=this._getCountValue(DOM.getText(d[0]));if(isNaN(b))b=0;}else b=0;var e=DOM.scry(a,'.sec');if(e.length>0){c=this._getCountValue(DOM.getText(e[0]));if(isNaN(c))c=0;}else c=0;return Math.abs(c-b);},_sortNumericChanges:function(a,b){var c=this._getChangeRatio(a.cells[this._sortColumnIndex]),d=this._getChangeRatio(b.cells[this._sortColumnIndex]);return (c-d);},_ternaryCompare:function(a,b){if(a==b)return 0;if(a<b)return -1;return 1;},_sortCaseinsensitive:function(a,b){var c=DOM.getText(a.cells[this._sortColumnIndex]).toLowerCase(),d=DOM.getText(b.cells[this._sortColumnIndex]).toLowerCase();return this._ternaryCompare(c,d);},_isNumber:function(a){return !isNaN(parseFloat(a))&&isFinite(a);},_sortDataRaw:function(a,b){var c=a.cells[this._sortColumnIndex].getAttribute('data-raw'),d=b.cells[this._sortColumnIndex].getAttribute('data-raw');if(!(this._isNumber(c)&&this._isNumber(d)))return this._ternaryCompare(c,d);c=parseFloat(c);d=parseFloat(d);return (c-d);}});function SortTable_initAll(){if(window.sortTableInitialized)return;window.sortTableInitialized=true;tables=DOM.scry(document,'table.sortable');for(var a=0;a<tables.length;a++)new SortTable(tables[a]);}