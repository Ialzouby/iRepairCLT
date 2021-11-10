import Image from 'components/image'
import cx from 'classnames'
 import Link from 'components/link'
import local from 'styles/components/card.module.scss'
import layout from 'styles/layout.module.scss'

export default (props) => {
  const {
    type=false,
    link="#",
    className,
    children
  } = props

  return (
    <Link href={link}>
      <div className={cx(local.content_card, className)}>
        <div className={cx(local.l1, {[local[type]]: type})} />
        <div className={cx(local.l2, {[local[type]]: type})} />
        <div className={cx(local.inner, layout.f_col, layout.align_center, layout.justify_between)}>
          {children}
        </div>
      </div>
    </Link>
  )
}
