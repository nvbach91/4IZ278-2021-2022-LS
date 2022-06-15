interface IObject {
  [key: string]: any;
}

export const stringAccess = (obj: IObject, path: string): any => {
  if (path.includes('.')) {
    return path.split('.').reduce((r, k) => r[k], obj)
  } else {
    return obj[path];
  }
};

