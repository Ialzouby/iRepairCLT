export default (req, res) => {
  res.redirect(`https://${req.query.link.join('/')}`)
}