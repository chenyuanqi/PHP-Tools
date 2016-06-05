function Storage() {
    this.storage = window.localStorage;
}

Storage.prototype = {

    fetchCatalog: function() {
        return JSON.parse(this.storage.getItem('catalog') || '{"length":2,"catalogs":[{"id":0,"name":"php","length":0},{"id":1,"name":"javascript","length":0}]}')
    },

    saveCatalog: function(catalogs) {
        this.storage.setItem('catalog', JSON.stringify(catalogs));
    },

    fetchTask: function() {
        return JSON.parse(this.storage.getItem('task')) || {"0":[{"title":"PHP 匿名函数","content":"<div>$type = 'test';</div>$foo &nbsp;= function($item) use ($type){<div>&nbsp; &nbsp; return $item.' | '.$type;<br><div>}</div></div>","size":133,"createTime":"21/05/2016, 00:33:50","updateTime":"21/05/2016, 00:33:50"}],"1":[{"title":"ES6 promise的用法","content":"p.then(data =&gt;{<br>&nbsp;&nbsp;&nbsp; // dosomething<br>}).catch(err =&gt; {<br><br>});","size":90,"createTime":"13/12/2015, 10:16:29","updateTime":"13/12/2015, 10:16:29"}]};
    },

    saveTask: function(tasks) {
        this.storage.setItem('task', JSON.stringify(tasks));
    },

    getCid: function() {
        return JSON.parse(this.storage.getItem('taskOfCatalogId')) || 0;
    },

    saveCid: function(cid) {
        this.storage.setItem('taskOfCatalogId', JSON.stringify(cid));
    },

    getEditTask: function() {
        return JSON.parse(this.storage.getItem('editTask')) || this.fetchTask()[0][0] || {};
    },

    saveEditTask: function(task) {
        this.storage.setItem('editTask', JSON.stringify(task));
    }
}

