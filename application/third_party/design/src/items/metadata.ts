module BP3D.Items {
  /** Meta data for items. */
  export interface Metadata {
    model_id?: model_id;
    short_menu_key?: string;
    itemCountertop?: string;
    itemExteriocolor?: string;
    itemInteriorcolor?: string;
    itemSkirting?: string;
    /** Name of the item. */
    itemName?: string;

    /** Type of the item. */
    itemType?: number;
    
    /** Url of the model. */
    modelUrl?: string;

    /** Resizeable or not */
    resizable?: boolean;
  }
}