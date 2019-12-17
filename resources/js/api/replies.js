
export function createReply(artileId,data) {
    return axios({
        url: '/api/articles/'+artileId+'/replies',
        method: 'post',
        data
    })
}
