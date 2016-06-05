<?php
    require_once('../config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $_CFG['note']['title'];?></title>
    <link rel="stylesheet" href="css/style.css">
    <style> [v-cloak] { display: none; } </style>
</head>
<body>
    <div class="header">
        <div class="title"><?php echo $_CFG['note']['title'];?></div>
    </div>
    <div class="content">
        <div class="catalog">
            <ul class="list">
                <li class="item" v-for="catalog in catalogs.catalogs | orderBy 'id' 1" @click="taskOfCatalogId = catalog.id" :class="{active: catalog.id == taskOfCatalogId}">
                    {{ catalog.name }}
                    ({{ tasks[catalog.id].length}})
                <label @click="removeCatalog(catalog)" class="delete">&times;</label>
                </li>
            </ul>
            <div class="add" v-on:click="toggleModel">
                <?php echo $_CFG['note']['add_category'];?>
            </div>
        </div>
        <div class="task">
            <div class="list">
                <div class="item" v-for="task in tasks[taskOfCatalogId]" @click="editTask = task" :class="{active: task == editTask || task.title == editTask.title}" v-text="task.title">
                    <div class="date" v-text="task.updateTime">
                    </div>
                </div>
            </div>
            <div class="add" @click="toggleTaskPanel">
                <?php echo $_CFG['note']['add_note'];?>
            </div>
        </div>
        <div class="detail">
            <div class="detail-box">
                <div class="detail-title" :class="{editing: editable}">
                    <div class="btns">
                        <a class="btn btn-edit" @click="editable = true" v-show="!editable">编辑</a>
                        <a class="btn btn-delete" @click="removeTask" v-show="!editable">删除</a>
                        <a class="btn btn-save" @click="saveTask" v-show="editable">保存</a>
                    </div>
                    <div class="note-text" contenteditable="{{ editable }}" v-text="editTask.title">
                    </div>
                </div>
                <div class="detail-date" :class="{editing: editable}">
                    <div v-show="editTask.createTime" v-cloak>
                        创建于: {{ editTask.createTime }}
                        更新于：{{ editTask.updateTime }}
                    </div>
                </div>
                <div class="edit-content" :class="{editing: editable}" contenteditable="{{ editable }}" v-html="editTask.content">
                </div>
            </div>
        </div>
    </div>
    <div class="model" v-show="model" v-cloak>
        <div class="model-body">
            <input type="text" v-model="newCatalog"  v-on:keyup.enter="addCatalog" placeholder="输入分类名">
            <a class="btn" v-on:click="addCatalog">提交</a>
        </div>
    </div>
    <script src="js/vue.js"></script>
    <script src="js/storage.js"></script>
    <script src="js/note.js"></script>
</body>
</html>
