URL：/usr/sign_up

说明：用户注册信息

`header`：     `content-type`:`application/json`

方法：POST

参数：

| 字段     | 含义                 | 类型   | 限制                        |
| -------- | -------------------- | ------ | --------------------------- |
| mail     | 用户邮箱             | string | 符合邮箱格式                |
| usr      | 用户名               | string | 8-16个字符 只包含字母和数字 |
| pwd      | 密码                 | string | 8-16个字符 只包含字母和数字 |
| iden-ord | 用户类型为普通用户   | bool   | 无                          |
| iden-dev | 用户类型为开发者     | bool   | 无                          |
| iden-lab | 用户类型为实验室官方 | bool   | 无                          |

响应：

| 字段   | 含义                                                         | 类型 |
| ------ | ------------------------------------------------------------ | ---- |
| status | 返回成功与否 200：注册成功 401：注册失败（用户已经注册）404：链接失败，找不到对象 | int  |



URL：/usr/sign_in

说明：用户登录信息

方法：POST

`header`：    `content-type`:`application/json`

参数：

| 字段 | 含义   | 类型   | 限制                        |
| ---- | ------ | ------ | --------------------------- |
| usr  | 用户名 | string | 8-16个字符 只包含字母和数字 |
| pwd  | 密码   | string | 8-16个字符 只包含字母和数字 |

响应：

| 字段   | 含义                                                         | 类型 |
| ------ | ------------------------------------------------------------ | ---- |
| status | 返回成功与否 200：注册成功 401：登录失败（用户未注册） 403：没有权限（密码错误）404：网络繁忙 | int  |



URL：/usr/info/mail

说明：修改用户邮箱

方法：POST

`header`：    `content-type`:`application/json`

参数：

| 字段 | 含义   | 类型   | 限制           |
| ---- | ------ | ------ | -------------- |
| mail | 新邮箱 | string | 必须为邮箱格式 |

响应：

| 字段   | 含义                          | 类型 |
| ------ | ----------------------------- | ---- |
| status | 200：修改成功                 | int  |
| status | 401：更改失败（邮箱已被注册） | int  |



URL：/usr/info/name

说明：修改用户昵称

方法：POST

`header`：    `content-type`:`application/json`

参数：

| 字段 | 含义     | 类型   | 限制                        |
| ---- | -------- | ------ | --------------------------- |
| name | 用户昵称 | string | 8-16个字符 只包含字母和数字 |

响应：

| 字段   | 含义          | 类型 |
| ------ | ------------- | ---- |
| status | 200：修改成功 | int  |



URL：/usr/info/password

说明：修改用户密码

方法：POST

`header`：    `content-type`:`application/json`

参数：

| 字段     | 含义     | 类型   | 限制                        |
| -------- | -------- | ------ | --------------------------- |
| password | 用户密码 | string | 8-16个字符 只包含字母和数字 |

响应：

| 字段   | 含义          | 类型 |
| ------ | ------------- | ---- |
| status | 200：修改成功 | int  |



URL：/usr/info/collection

说明：获取用户收藏

方法：GET

`header`：    `content-type`:`application/json`

参数：

| 字段 | 含义                          | 类型 | 限制           |
| ---- | ----------------------------- | ---- | -------------- |
| page | 显示第几页的内容 一页20个项目 | int  | 不得超过总页数 |

响应：

| 字段          | 含义                                             | 类型   |
| ------------- | ------------------------------------------------ | ------ |
| status        | 返回成功与否  200：OK  404：链接失败，找不到对象 | int    |
| total         |                                                  | string |
| project       | 以下内容为project数组的单个元素                  | array  |
| photo_url     | 项目照片的url                                    | string |
| project_name  | 项目名                                           | string |
| project_intro | 项目简介                                         | string |



URL：/usr/info/follow

说明：获取用户关注的项目

方法：GET

`header`：    `content-type`:`application/json`

参数：

| 字段 | 含义                          | 类型 | 限制           |
| ---- | ----------------------------- | ---- | -------------- |
| page | 显示第几页的内容 一页20个项目 | int  | 不得超过总页数 |

响应：

| 字段          | 含义                                             | 类型   |
| ------------- | ------------------------------------------------ | ------ |
| status        | 返回成功与否  200：OK  404：链接失败，找不到对象 | int    |
| link          | 下一个列表的位置                                 | string |
| project       | 以下内容为project数组的单个元素                  | array  |
| photo_url     | 项目照片的url                                    | string |
| project_name  | 项目名                                           | string |
| project_intro | 项目简介                                         | string |



URL：/usr/info/public

说明：获取用户发布的项目

方法：GET

`header`：    `content-type`:`application/json`

参数：

| 字段 | 含义                          | 类型 | 限制           |
| ---- | ----------------------------- | ---- | -------------- |
| page | 显示第几页的内容 一页20个项目 | int  | 不得超过总页数 |

响应：

| 字段          | 含义                                             | 类型   |
| ------------- | ------------------------------------------------ | ------ |
| status        | 返回成功与否  200：OK  404：链接失败，找不到对象 | int    |
| link          | 下一个列表的位置                                 | string |
| project       | 以下内容为project数组的单个元素                  | array  |
| photo_url     | 项目照片的url                                    | string |
| project_name  | 项目名                                           | string |
| project_intro | 项目简介                                         | string |



URL：/usr/info/participate

说明：获取用户参与的项目

方法：GET

`header`：    `content-type`:`application/json`

参数：

| 字段 | 含义                          | 类型 | 限制           |
| ---- | ----------------------------- | ---- | -------------- |
| page | 显示第几页的内容 一页20个项目 | int  | 不得超过总页数 |

响应：

| 字段          | 含义                                             | 类型   |
| ------------- | ------------------------------------------------ | ------ |
| status        | 返回成功与否  200：OK  404：链接失败，找不到对象 | int    |
| link          | 下一个列表的位置                                 | string |
| project       | 以下内容为project数组的单个元素                  | array  |
| photo_url     | 项目照片的url                                    | string |
| project_name  | 项目名                                           | string |
| project_intro | 项目简介                                         | string |



URL：/usr/info/collect

说明：更改收藏状态

方法：POST

`header`：    `content-type`:`application/json`

参数：

| 字段          | 含义         | 类型 | 限制                     |
| ------------- | ------------ | ---- | ------------------------ |
| collect       | 更改收藏状态 | int  | 0：取消收藏 1：添加收藏  |
| participateid | 项目ID       | int  | 是存在的数据库中的项目号 |

响应：

| 字段   | 含义          | 类型 |
| ------ | ------------- | ---- |
| status | 200：修改成功 | int  |



URL：/usr/info/collect_status

说明：获取收藏状态

方法：GET

`header`：    `content-type`:`application/json`

参数：

| 字段          | 含义   | 类型 | 限制                     |
| ------------- | ------ | ---- | ------------------------ |
| participateid | 项目ID | int  | 是存在的数据库中的项目号 |

响应：

| 字段   | 含义                | 类型 |
| ------ | ------------------- | ---- |
| status | 0：未收藏 1：已收藏 | int  |



URL：/usr/info/attention

说明：更改关注状态

方法：POST

`header`：    `content-type`:`application/json`

参数：

| 字段      | 含义         | 类型 | 限制                    |
| --------- | ------------ | ---- | ----------------------- |
| attention | 更改关注状态 | int  | 0：取消关注 1：添加关注 |
| user_id   | 被关注者ID   | int  | 是已注册的用户          |

响应：

| 字段   | 含义          | 类型 |
| ------ | ------------- | ---- |
| status | 200：修改成功 | int  |



URL：/usr/info/attention_status

说明：获取关注状态

方法：GET

`header`：    `content-type`:`application/json`

参数：

| 字段    | 含义       | 类型 | 限制           |
| ------- | ---------- | ---- | -------------- |
| user_id | 被关注者ID | int  | 是已注册的用户 |

响应：

| 字段   | 含义                | 类型 |
| ------ | ------------------- | ---- |
| status | 0：未关注 1：已关注 | int  |



URL：/usr/info/delete_project

说明：删除创意项目

方法：POST

`header`：    `content-type`:`application/json`

参数：

| 字段       | 含义               | 类型 | 限制                 |
| ---------- | ------------------ | ---- | -------------------- |
| project_id | 要删除的创意项目ID | int  | 是存在于数据库的项目 |

响应：

| 字段   | 含义          | 类型 |
| ------ | ------------- | ---- |
| status | 200：修改成功 | int  |



URL：/usr/info/create_project

说明：发布创意项目

方法：POST

`header`：    `content-type`:`application/json`

参数：

| 字段                | 含义               | 类型   | 限制                      |
| ------------------- | ------------------ | ------ | ------------------------- |
| project_name        | 创意项目标题       | string | 1-30个字符                |
| project_class       | 选择项目分类       | int    | 0：生活<br>1：科技<br>2： |
| project_grade       | 悬赏分             | int    | 0-10000<br>单人次悬赏分   |
| project_participant | 参与者上限         | int    | 0-10<br>为0不接受悬赏     |
| project_time        | 发布时间           | time   |                           |
| project_intro       | 简介               | string | 10-300个字符              |
| project_cover       | 封面 待修改        |        |                           |
| project_pic         | 视图片上传形式修改 |        |                           |

响应：

| 字段   | 含义          | 类型 |
| ------ | ------------- | ---- |
| status | 200：发布成功 | int  |



URL：/usr/info/comment

说明：发布评论

方法：POST

`header`：    `content-type`:`application/json`

参数：

| 字段       | 含义               | 类型   | 限制                     |
| ---------- | ------------------ | ------ | ------------------------ |
| project_id | 被评论的创意项目ID | int    | 是存在的数据库中的项目号 |
| comment    | 评论内容           | string | 1-200个字符 评论内容     |

响应：

| 字段   | 含义          | 类型 |
| ------ | ------------- | ---- |
| status | 200：评论成功 | int  |

