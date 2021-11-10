import { useState, useEffect, useRef } from 'react'
import cx from 'classnames'

import Carrot from 'components/carrot'

import local from 'styles/components/tab.module.scss'
import layout from 'styles/layout.module.scss'

export default (props) => {
  const { header, children, size="lg" } = props
  const tabRef = useRef(null)
  const [tabState, setTabState] = useState(false)
  useEffect(() => {
    if (tabRef.current) {
      const tabHeight = `${[...tabRef.current.children].map((x) => x.offsetHeight).reduce((a, b) => a + b)}px`
      tabRef.current.style.height = tabState ? tabHeight : "0px"
    }
  }, [tabState])
  return (
    <div className={cx(local.tab_outer, local[size])} onClick={() => setTabState(!tabState)}>
      <div className={cx(layout.f_row, layout.justify_between, layout.align_center)}>
        {size == "sm" ? <h6>{header}</h6> : <h5>{header}</h5>}
        <div className={cx(local.carrot, { [local.rotate]: tabState })}>
          <Carrot />
        </div>
      </div>
      {children && (
        <div className={local.tab_inner} ref={tabRef}>
          <div>
            {children}
          </div>
        </div>
      )}
    </div>
  )
}