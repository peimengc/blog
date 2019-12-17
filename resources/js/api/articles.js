export function fetchList(query) {
    return axios({
        url: '/api/articles',
        method: 'get',
        params: query
    })
}

export function fetchArticle(id) {
    return axios({
        url: '/api/articles/'+id,
        method: 'get'
    })
}

export function createArticle(data) {
    return axios({
        url: '/api/articles',
        method: 'post',
        data
    })
}

export function updateArticle(id,data) {
    return axios({
        url: '/api/articles/'+id,
        method: 'put',
        data
    })
}
